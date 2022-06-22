import { Component, OnDestroy, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { User } from 'src/core/models';
import { SubscriptionLike as ISubscription } from 'rxjs';
import { UserService } from 'src/core/services';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';

@Component({
  selector: 'app-add-user',
  templateUrl: 'add-user.component.html',
  styleUrls: ['add-user.component.scss']
})
export class AddUserComponent implements OnDestroy {

  userForm: FormGroup = new FormGroup({});
  isFormSubmitted: boolean = false;
  submitSubscriber?: ISubscription;
  isLoading: boolean = false;

  constructor(
    private formBuilder: FormBuilder,
    private userService: UserService,
    private snackBar: MatSnackBar,
    private router: Router,
  ) {
    this.buildForm(new User({}));
  }

  /**
  * Build form data
  * @param data
  */
  buildForm(data: User) {
    this.userForm = this.formBuilder.group({
      id: [data.id],
      name: [data.name, Validators.required],
      email: [data.email, [Validators.required, Validators.email]],
      phone: [data.phone, [Validators.required, Validators.pattern('[1-9]{1}[0-9]{9}')]]
    });
  }

  /**
   * Get form
   */
  get f() {
    return this.userForm.controls;
  }

  /**
  * Submit new record
  */
  onSubmit() {
    this.isFormSubmitted = true;
    if (this.userForm.invalid) {
      return;
    }
    const user: User = this.userForm.getRawValue();
    this.isLoading = true;
    this.submitSubscriber = this.userService.addUser(user)
      .subscribe((response: any) => {
        if (response.status === true) {
          this.showMessage(response.message);
          this.router.navigateByUrl('/user');
        } else {
          this.showMessage(response.message);
        }
      }, (error: any) => {
        this.showMessage(error.message || "Something went wrong");
      });
  }

  /**
   * Show snackBar message.
   * @param message
   */
  showMessage(message: string) {
    this.snackBar.open(message, '', {
      duration: 2000,
      verticalPosition: 'top',
      horizontalPosition: 'right'
    });
    this.isLoading = false;
    this.isFormSubmitted = false;
  }

  /**
   * Unsubscribing subscription
   */
  ngOnDestroy() {
    if (this.submitSubscriber) {
      this.submitSubscriber.unsubscribe();
    }
  }
}

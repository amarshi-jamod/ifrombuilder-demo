import { Component, OnDestroy, OnInit } from '@angular/core';
import { MatTableDataSource } from '@angular/material/table';
import { SubscriptionLike as ISubscription } from 'rxjs';
import { UserService } from 'src/core/services';

@Component({
  selector: 'app-user-list',
  templateUrl: 'user-list.component.html',
  styleUrls: ['user-list.component.scss']
})
export class UserListComponent implements OnInit, OnDestroy {

  // Colums used to display records
  displayedColumns: string[] = ['id', 'name', 'email', 'phone'];
  dataSource = new MatTableDataSource([]);
  userListSubscriber?: ISubscription;
  isLoading: boolean = true;

  constructor(
    private userService: UserService,
  ) { }

  ngOnInit(): void {
    this.getAllUsers();
  }

  /**
   * Get all records
   */
  getAllUsers() {
    this.isLoading = true;
    this.userListSubscriber = this.userService.getUsers().subscribe(res => {
      this.dataSource.data = res.data;
      this.isLoading = false;
    }, error => {
      this.isLoading = false;
    });
  }

  /**
   * Unsubscribing subscription
   */
  ngOnDestroy() {
    if (this.userListSubscriber) {
      this.userListSubscriber.unsubscribe();
    }
  }

}

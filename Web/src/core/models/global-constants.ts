import { environment } from 'src/environments/environment';

export const GlobalConstants = {
    Host: environment.Host,
    ApiUrl: {
        User: {
            GetAllUsers: 'iformbuilder.php?action=get',
            AddUser: 'iformbuilder.php?action=create',
        }
    }
};


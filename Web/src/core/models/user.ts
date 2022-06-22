

export class User {
    id: number;
    name: string;
    email: string;
    phone: string;

    constructor(data: any) {
        this.id = data.id || 0;
        this.name = data.name || '';
        this.email = data.email || '';
        this.phone = data.phone || '';
    }
}

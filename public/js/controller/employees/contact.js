/**
 * Created by Chantouch on 20/03/2017.
 */

const profile = new Vue({
        el: "#contacts",
        data(){
            return {
                contacts: {},
                contacts_deleted: {},
                fill_contact: {
                    'name': '',
                    'phone_number': '',
                    'position_id': '',
                    'email': '',
                    'department_id': '',
                    'status': '',
                    'id': '',
                    'position': '',
                    'department': '',
                },
                new_contact: {
                    'name': '',
                    'phone_number': '',
                    'position_id': '',
                    'email': '',
                    'department_id': '',
                    'status': ''
                },
                department: {},
                position: {},
                show_contact: {},
            }
        },
        created(){
            this.fetchContacts();
            this.fetchContactsDeleted();
            this.fetchDepartment();
            this.fetchPosition();
        },
        methods: {
            fetchContacts(){
                this.$http.get('/employee/contacts').then((response) => {
                    this.contacts = response.data;
                    //console.log(response.data);
                })
            },
            fetchContactsDeleted(){
                this.$http.get('/employee/contact/deleted').then((response) => {
                    this.contacts_deleted = response.data;
                    //console.log(response.data);
                })
            },
            fetchDepartment(){
                this.$http.get('/api/admin/list-department').then((response) => {
                    this.department = response.data;
                })
            },
            fetchPosition(){
                this.$http.get('/api/admin/list-position').then((response) => {
                    this.position = response.data;
                })
            },
            addContact()
            {
                $("#add-contact").modal('show');
            },
            storeContact()
            {
                let fill = this.new_contact;
                this.$http.post('/employee/contacts/', fill).then((response) => {
                    this.new_contact = {
                        'name': '',
                        'phone_number': '',
                        'position_id': '',
                        'email': '',
                        'department_id': '',
                        'status': ''
                    };
                });
                this.fetchContacts();
                $("#add-contact").modal('hide');
                toastr.success('Contact successfully created.', 'Success Alert', {timeOut: 5000});
            },
            editContact(obj, show)
            {
                let fill = this.fill_contact;
                fill.name = obj.name;
                fill.email = obj.email;
                fill.phone_number = obj.phone_number;
                fill.position_id = obj.position.id;
                fill.position = obj.position.name;
                fill.department_id = obj.department.id;
                fill.department = obj.department.name;
                fill.status = obj.status;
                fill.id = obj.id;
                switch (show) {
                    case "edit-contact":
                        $("#edit-contact").modal('show');
                        break;
                    case "show-contact":
                        $("#show-contact").modal('show');
                        break;
                    default:
                        break;
                }
            },
            updateContact(id)
            {
                let input = this.fill_contact;
                //console.log(id);
                this.$http.patch('/employee/contacts/' + id, input).then((response) => {
                    this.new_contact = {
                        'name': '',
                        'phone_number': '',
                        'email': '',
                        'position_id': '',
                        'department_id': '',
                        'status': '',
                        'id': ''
                    };
                    this.fetchContacts();
                    $("#edit-contact").modal('hide');
                    toastr.success('Contact successfully updated.', 'Success Alert', {timeOut: 5000});
                }, (response) => {
                    //this.formErrors = response.data;
                    console.log(response);
                })
            },
            deleteContact(obj)
            {
                let con = confirm('Are you sure to delete this contact?');
                if (con) {
                    this.$http.delete('/employee/contacts/' + obj.id).then((response) => {
                        this.fetchContacts();
                        toastr.success("Contact deleted successfully.", "Success Alert", {timeOut: 5000});
                    });
                }
            },
            restoreContact(obj)
            {
                let con = confirm('Are you sure want to restore this contact?');
                if (con) {
                    this.$http.put('/employee/contact/restore_contact/' + obj.id).then((response) => {
                        this.fetchContactsDeleted();
                        toastr.success("Contact restored successfully.", "Success Alert", {timeOut: 5000});
                    });
                }
            }
        }
    })
    ;

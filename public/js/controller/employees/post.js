/**
 * Created by Chantouch on 23/03/2017.
 */

const post = new Vue({
    el: "#create-post",
    data(){
        return {
            contacts: {},
            new_contact: {
                'contact_id': '',
                'department_id': '',
                'phone_number': '',
            },
            post: {
                'name': '',
                'status': '',
                'hire_number': '',
                'industry_id': '',
                'functions_id': '',
                'post_id': '',
                'city_id': '',
                'salary': '',
                'job_description': '',
                'level_id': '',
                'contract_type_id': '',
                'year_experience': '',
                'qualification_id': '',
                'field_of_study': '',
                'gender': '',
                'age_from': '',
                'age_to': '',
                'marital_status': '',
                'requirement_des': '',
                'contact_id': '',
                'employee_id': '',
                'closing_date': '',
                'published_date': ''
            }
        }
    },
    created(){
        this.fetchContacts();
    },
    methods: {
        fetchContacts(){
            this.$http.get('/employee/contacts').then((response) => {
                this.contacts = response.data;
                //console.log(response.data);
            })
        },
        changeData(){
            console.log('Data changed');
        },
        saveDraft(){
            let input = this.post;
            this.$http.post('/employee/posts-draft', input).then((response) => {
                this.post = {
                    'name': '',
                    'status': '',
                    'hire_number': '',
                    'industry_id': '',
                    'functions_id': '',
                    'post_id': '',
                    'city_id': '',
                    'salary': '',
                    'job_description': '',
                    'level_id': '',
                    'contract_type_id': '',
                    'year_experience': '',
                    'qualification_id': '',
                    'field_of_study': '',
                    'gender': '',
                    'age_from': '',
                    'age_to': '',
                    'marital_status': '',
                    'requirement_des': '',
                    'contact_id': '',
                    'employee_id': '',
                    'closing_date': '',
                    'published_date': ''
                };
                // $('#create-item').modal('hide');
                toastr.success("Post drafted successfully!", 'Success Alert', {timeOut: 5000});
            }, (response) => {
                console.log('Error while create new post.');
            })
        }
    }
});

/**
 * Created by Chantouch on 3/3/2017.
 */
let hashid = $('#hashid').val();
const contract = new Vue({
    el: '#verify-job-status',
    data(){
        return {
            prop: {
                pagination: {
                    type: Object,
                    required: true
                },
                offset: {
                    type: Number,
                    default: 4
                }
            },
            pagination: {},
            offset: 4,
            newItem: {
                'name': '',
                'email': '',
                'status': '',
            },
            fillItem: {
                gender: '',
                id: '',
                created_at: '',
                closing_data: '',
                hire_number: '',
                employee_id: '',
                function_id: '',
                city_id: '',
                city: '',
                contact_id: '',
                age_to: '',
                age_from: '',
                contract_type_id: '',
                field_of_study: '',
                industry_id: '',
                qualification: '',
                post_id: '',
                level_id: '',
                job_description: '',
                marital_status: '',
                industry: '',
                level: '',
                name: '',
                published_date: '',
                qualification_id: '',
                requirement_des: '',
                salary: '',
                slug: '',
                status: '',
                updated_at: '',
                year_experience: '',
            },
            items: [],
            formErrors: {},
            formErrorsUpdate: {},
            employee: {
                id: hashid
            },
            jobs_available: [],
            all_jobs: [],
            count_all_jobs: []
        }
    },
    computed: {
        isActive(){
            return this.pagination.current_page;
        },
        pagesNumber(){
            if (!this.pagination.to) {
                return [];
            }
            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + (this.offset * 2);
            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            let pagesArray = [];
            for (from = 1; from <= to; from++) {
                pagesArray.push(from);
            }
            return pagesArray;
        }
    },
    created(){
        this.fetchJobsNeedVerify(this.employee.id);
        this.fetchJobsAvailable(this.employee.id);
        this.fetchAllJobs(this.employee.id, this.pagination.current_page);
    },
    methods: {
        fetchJobsNeedVerify (emp_id)
        {
            this.$http.get('/api/admin/employees/jobs-need-verify/' + emp_id).then((response) => {
                this.items = response.data;
                //console.log(response.data);
                //this.pagination = response.data;
            });
        },

        fetchJobsAvailable(emp_id){
            this.$http.get('/api/admin/employees/get-jobs-available/' + emp_id).then((response) => {
                //console.log(response.data);
                this.jobs_available = response.data;
            });
        },

        fetchAllJobs(emp_id, page){
            this.$http.get('/api/admin/employees/jobs/' + emp_id + '?page=' + page).then((response) => {
                this.all_jobs = response.data.data;
                this.pagination = response.data;
                //console.log(response);
            });
        },

        countALLJob(){
            this.$http.get('/api/admin/employees/jobs/ND/ND').then((response) => {
                this.count_all_jobs = response.data;
            });
        },

        createItem(){
            let input = this.newItem;
            this.$http.post('/api/admin/employees/manage', input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {
                    gender: '',
                    id: '',
                    created_at: '',
                    closing_data: '',
                    hire_number: '',
                    employee_id: '',
                    function_id: '',
                    city_id: '',
                    city: '',
                    contact_id: '',
                    age_to: '',
                    age_from: '',
                    contract_type_id: '',
                    field_of_study: '',
                    industry_id: '',
                    qualification: '',
                    post_id: '',
                    level_id: '',
                    job_description: '',
                    marital_status: '',
                    industry: '',
                    level: '',
                    name: '',
                    published_date: '',
                    qualification_id: '',
                    requirement_des: '',
                    salary: '',
                    slug: '',
                    status: '',
                    updated_at: '',
                    year_experience: '',
                };
                $('#create-item').modal('hide');
                toastr.success("Item created success fully!", 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            })
        },

        editItem(item){
            let fill = this.fillItem;
            fill.name = item.name;
            fill.job_description = item.job_description;
            fill.status = item.status;
            fill.gender = item.gender;
            fill.created_at = item.created_at;
            fill.closing_data = item.closing_data;
            fill.field_of_study = item.field_of_study;
            fill.employee_id = item.employee_id;
            fill.industry_id = item.industry_id;
            fill.function_id = item.function_id;
            fill.city_id = item.city_id;
            fill.contact_id = item.contact_id;
            fill.age_to = item.age_to;
            fill.age_from = item.age_from;
            fill.contract_type_id = item.contract_type_id;
            fill.hire_number = item.hire_number;
            fill.published_date = item.published_date;
            fill.qualification_id = item.qualification_id;
            fill.level_id = item.level_id;
            fill.marital_status = item.marital_status;
            fill.requirement_des = item.requirement_des;
            fill.salary = item.salary;
            fill.year_experience = item.year_experience;
            fill.id = item.id;
            fill.slug = item.slug;
            fill.updated_at = item.updated_at;
            fill.post_id = item.post_id;
            $("#verify-job").modal('show');
        },

        updateItem(id){
            let input = this.fillItem;
            let emp_id = this.employee.id;
            this.$http.patch('/api/admin/employees/manage/' + id, input).then((response) => {
                this.fetchJobsNeedVerify(emp_id);
                this.fetchJobsAvailable(emp_id);
                this.fetchAllJobs(emp_id);
                this.newItem = {
                    gender: '',
                    id: '',
                    created_at: '',
                    closing_data: '',
                    hire_number: '',
                    employee_id: '',
                    function_id: '',
                    city_id: '',
                    city: '',
                    contact_id: '',
                    age_to: '',
                    age_from: '',
                    contract_type_id: '',
                    field_of_study: '',
                    industry_id: '',
                    qualification: '',
                    post_id: '',
                    level_id: '',
                    job_description: '',
                    marital_status: '',
                    industry: '',
                    level: '',
                    name: '',
                    published_date: '',
                    qualification_id: '',
                    requirement_des: '',
                    salary: '',
                    slug: '',
                    status: '',
                    updated_at: '',
                    year_experience: '',
                };
                $("#verify-job").modal('hide');
                toastr.success('This job has been updated status successfully.', 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            })
        },

        deleteItem(item){
            let con = confirm("Are you sure to do that?");
            if (con) {
                this.$http.delete('/api/admin/employees/manage/' + item.id).then((response) => {
                    this.changePage(this.pagination.current_page);
                    toastr.success("Item deleted successfully.", "Success Alert", {timeOut: 5000});
                });
            }
        },

        changePage(page){
            this.pagination.current_page = page;
            // this.fetchJobsNeedVerify(page);
            this.fetchAllJobs(this.employee.id, page);
        }
    }
});
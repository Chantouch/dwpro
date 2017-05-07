/**
 * Created by Chantouch on 3/3/2017.
 */
const wrapper = new Vue({
    el: '#wrapper',
    data(){
        return {
            data: [],
            profile: {},
            profile_city: {},
            edit: false,
            fill_profile: {
                id: "",
                about_me: ""
            },
            show: true,
            new_about_me: {
                about_me: ''
            },
            file_work_experience: {
                job_title: ""
            },
            formErrors: {},
        }
    },
    computed: {},
    created(){
        this.fetchProfile();
    },
    methods: {
        fetchProfile(){
            this.$http.get('/candidate/api/profile').then((response) => {
                this.data = response.data;
                if (response.data.profile !== null) {
                    this.profile = response.data.profile;
                    this.profile_city = response.data.profile.city;
                }
                this.edit = true;
            });
        },
        editAboutMe(id){
            let fill = this.fill_profile;
            this.$http.get('/candidate/api/profile').then(function (response) {
                let data = response.data.profile;
                fill.id = response.data.id;
                fill.about_me = data.about_me;
            });
            switch (id) {
                case "about_me":
                    this.show = false;
                    this.edit = true;
                    break;
                case "work_experience":
                    console.log('Thanks');
                    // this.show = false;
                    // this.edit = true;
                    break;
                case "cancel":
                    this.show = true;
                    this.edit = false;
                    break;
                default:
                    break;
            }
        },
        updateAboutMe(id){
            let input = this.fill_profile;
            let input_new = this.new_about_me;
            switch (id) {
                case "about_me":
                    this.$http.patch('/candidate/api/profile-update', input).then((response) => {
                        this.new_about_me = {
                            about_me: "",
                            id: "",
                            job_title: ""
                        };
                        this.fetchProfile();
                        this.show = true;
                        this.edit = false;
                    });
                    break;
                case "create_about_me":
                    this.$http.post('/candidate/api/profile-create', input_new).then((response) => {
                        this.new_about_me = {
                            about_me: "",
                        };
                        this.fetchProfile();
                        this.show = true;
                        this.edit = false;
                    });
                    break;
                default:
                    break;
                    this.fetchProfile();
            }
        },
        save_about(){
            let input = this.fill_profile;
            this.$http.patch('/candidate/api/profile-update', input).then((response) => {
                this.new_about_me = {
                    about_me: "",
                    id: ""
                };
                this.fetchProfile();
                this.show = true;
                this.edit = false;
                this.formErrors = false;
            }, (response) => {
                this.formErrors = response.data;
            });
        },
        create_work_experience(){
            let input = this.file_work_experience;
            let vm = this;
            vm.$http.post('/candidate/api/work-experience/create', input).then((response) => {
                this.file_work_experience = {
                    job_title: ""
                }
            }, (response) => {
                this.formErrors = response.data;
            });
        }
    }
});
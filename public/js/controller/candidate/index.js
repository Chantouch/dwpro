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
            }
        }
    },
    computed: {},
    created(){
        this.fetchProfile();
    },
    methods: {
        fetchProfile(){
            this.$http.get('/candidate/api/profile').then((response) => {
                //console.log(response.data);
                this.data = response.data;
                this.profile = response.data.profile;
                this.profile_city = response.data.profile.city;
                this.edit = true;
            })
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
                    alert('Nice work');
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
            this.$http.patch('/candidate/api/profile-update', input).then((response) => {
                this.new_about_me = {
                    about_me: "",
                    id: "",
                    job_title: ""
                };
            });
            this.fetchProfile();
            switch (id) {
                case "about_me":
                    this.show = true;
                    this.edit = false;
                    break;
                default:
                    break;
            }
        },
    }
});
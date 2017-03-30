/**
 * Created by Chantouch on 20/03/2017.
 */

const profile = new Vue({
    el: "#company-profile",
    data(){
        return {
            quick_facts: {},
            fill_profile: {
                "id": '',
                "name": "",
                "industry_id": '',
                "business_type_id": '',
                "city_id": '',
                "website": "",
                "address": '',
                "phone_number": '',
                "company_email": '',
                "number_employee": '',
                "tag_line": '',
                "longitude": '',
                "latitude": '',
                "currently_hiring": '',
                "about_us": '',
                "how_we_work": '',
                "looking_for": '',
            },
            new_profile: {
                "name": "",
                "industry_id": '',
                "business_type_id": '',
                "city_id": '',
                "website": "",
                "address": '',
                "phone_number": '',
                "company_email": '',
                "number_employee": '',
                "tag_line": '',
                "longitude": '',
                "latitude": '',
                "currently_hiring": '',
                "about_us": '',
                "how_we_work": '',
                "looking_for": '',
            },
            formErrorsUpdate: {},
            industry: {},
            business_type: {},
            profile: {},

        }
    },
    created(){
        this.fetchProfile();
        this.fetchIndustry();
        this.getBusinessType();
    },
    methods: {
        fetchProfile(){
            this.$http.get('/employee/edit-profile').then((response) => {
                this.profile = response.data;
                //console.log(response.data);
            })
        },
        fetchIndustry(){
            this.$http.get('/api/admin/list-industry').then((response) => {
                this.industry = response.data;
            })
        },
        getBusinessType(){
            this.$http.get('/api/admin/list-business-type').then((response) => {
                this.business_type = response.data;
            })
        },
        editProfile(id){
            let fill = this.fill_profile;
            this.$http.get('/employee/edit-profile').then(function (response) {
                let data = response.data;
                fill.id = response.data.id;
                fill.about_us = data.about_us;
                fill.business_type_id = data.business_type.id;
                fill.industry_id = data.industry.id;
                fill.city_id = data.city.id;
                fill.number_employee = data.number_employee;
                fill.number_employee = data.number_employee;
                fill.currently_hiring = data.currently_hiring;
                fill.address = data.address;
                fill.company_email = data.company_email;
                fill.latitude = data.latitude;
                fill.longitude = data.longitude;
                fill.looking_for = data.looking_for;
                fill.how_we_work = data.how_we_work;
                fill.name = data.name;
                fill.website = data.website;
                fill.phone_number = data.phone_number;
                fill.tag_line = data.tag_line;
            });
            switch (id) {
                case "about_us":
                    $("#edit-about-us").modal('show');
                    toastr.warning('You\'r updating your about profile..', 'Warning Alert', {timeOut: 5000});
                    break;
                case "quick_facts":
                    $("#edit-quick-facts").modal('show');
                    //toastr.success('Quick Facts successfully updated.', 'Success Alert', {timeOut: 5000});
                    break;
                case "how_we_work":
                    $("#edit-how-we-work").modal('show');
                    //toastr.success('How We Work successfully updated.', 'Success Alert', {timeOut: 5000});
                    break;
                case "looking_for":
                    $("#edit-looking-for").modal('show');
                    //toastr.success('How We Work successfully updated.', 'Success Alert', {timeOut: 5000});
                    break;
                case "google_maps":
                    $("#edit-google-maps").modal('show');
                    //toastr.success('How We Work successfully updated.', 'Success Alert', {timeOut: 5000});
                    break;
                case "company_information":
                    $("#edit-company-information").modal('show');
                    break;
                default:
                    break;
            }
        },
        updateProfile(id){
            let input = this.fill_profile;
            this.$http.patch('/employee/update-profile', input).then((response) => {
                this.new_profile = {
                    "name": "",
                    "industry_id": '',
                    "business_type_id": '',
                    "city_id": '',
                    "website": "",
                    "address": '',
                    "phone_number": '',
                    "company_email": '',
                    "number_employee": '',
                    "tag_line": '',
                    "longitude": '',
                    "latitude": '',
                    "currently_hiring": '',
                    "about_us": '',
                    "how_we_work": '',
                    "looking_for": '',
                    'id': ''
                };
                this.fetchProfile();
                switch (id) {
                    case "about_us":
                        $("#edit-about-us").modal('hide');
                        toastr.success('About us successfully updated.', 'Success Alert', {timeOut: 5000});
                        break;
                    case "quick_facts":
                        $("#edit-quick-facts").modal('hide');
                        toastr.success('Quick facts successfully updated.', 'Success Alert', {timeOut: 5000});
                        break;
                    case "how_we_work":
                        $("#edit-how-we-work").modal('hide');
                        toastr.success('How we work successfully updated.', 'Success Alert', {timeOut: 5000});
                        break;
                    case "looking_for":
                        $("#edit-looking-for").modal('hide');
                        toastr.success('Who we looking for successfully updated.', 'Success Alert', {timeOut: 5000});
                        break;
                    case "google_maps":
                        $("#edit-google-maps").modal('hide');
                        toastr.success('Google map was successfully updated.', 'Success Alert', {timeOut: 5000});
                        break;
                    case "company_information":
                        $("#edit-company-information").modal('hide');
                        toastr.success('Company information successfully updated.', 'Success Alert', {timeOut: 5000});
                        break;
                    default:
                        break;
                }
            }, (response) => {
                //this.formErrors = response.data;
            })
        },
    }
});

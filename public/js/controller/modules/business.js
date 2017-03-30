/**
 * Created by Chantouch on 3/3/2017.
 */
const business = new Vue({
    el: '#business_types',
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
                'description': '',
                'status': '',
            },
            fillItem: {
                'name': '',
                'description': '',
                'status': '',
                'id': ''
            },
            business_types: [],
            formErrors: {},
            formErrorsUpdate: {},

            model: {},
            columns: {},
            query: {
                page: 1,
                column: 'id',
                direction: 'desc',
                per_page: 15,
                search_column: 'id',
                search_operator: 'equal',
                search_input: ''
            },
            operators: {
                equal: '=',
                not_equal: '<>',
                less_than: '<',
                greater_than: '>',
                less_than_or_equal_to: '<=',
                greater_than_or_equal_to: '>=',
                in: 'IN',
                like: 'LIKE'
            },
            source: '/api/admin/modules/business-types',

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
        //this.fetchItems(this.pagination.current_page);
        this.fetchIndexData();
    },
    methods: {

        next(){
            if (this.model.next_page_url) {
                this.query.page++;
                this.fetchIndexData();
            }
        },
        prev(){
            if (this.model.prev_page_url) {
                this.query.page--;
                this.fetchIndexData();
            }
        },
        fetchIndexData() {
            let vm = this;
            this.$http.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
                .then(function (response) {
                    Vue.set(vm.$data, 'model', response.data.model);
                    Vue.set(vm.$data, 'columns', response.data.columns)
                })
                .catch(function (response) {
                    console.log(response);
                })
        },
        toggleOrder(column){
            if (column === this.query.column) {
                //only change direction
                if (this.query.direction === 'desc') {
                    this.query.direction = 'asc';
                } else {
                    this.query.direction = 'desc'
                }
            } else {
                this.query.column = column;
                this.query.direction = 'desc';
            }
            this.fetchIndexData();
        },
        fetchItems (page)
        {
            this.$http.get('/api/admin/modules/business-types?page=' + page).then((response) => {
                this.business_types = response.data.data;
                this.pagination = response.data;
            });
        },

        createItem(){
            let input = this.newItem;
            this.$http.post('/api/admin/modules/business-types', input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {
                    'name': '',
                    'description': '',
                    'status': ''
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
            fill.description = item.description;
            fill.status = item.status;
            fill.id = item.id;
            $("#edit-item").modal('show');
        },

        updateItem(id){
            let input = this.fillItem;
            this.$http.patch('/api/admin/modules/business-types/' + id, input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {
                    'name': '',
                    'description': '',
                    'status': '',
                    'id': ''
                };
                $("#edit-item").modal('hide');
                toastr.success('Item successfully updated.', 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            })
        },

        deleteItem(item){
            let con = confirm("Are you sure to do that?");
            if (con) {
                this.$http.delete('/api/admin/modules/business-types/' + item.id).then((response) => {
                    this.changePage(this.pagination.current_page);
                    toastr.success("Item deleted successfully.", "Success Alert", {timeOut: 5000});
                });
            }
        },

        changePage(page){
            this.pagination.current_page = page;
            this.fetchItems(page)
        }
    }
});
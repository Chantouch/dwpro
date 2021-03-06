/**
 * Created by Chantouch on 3/3/2017.
 */
const business = new Vue({
    el: '#business',
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
            items: [],
            formErrors: {},
            formErrorsUpdate: {},
            searchName: "",
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
        },
        //A computed property that holds only those items that match the searchName
        filterItem(){
            let item_array = this.items, searchName = this.searchName;
            if (!searchName) {
                return item_array;
            }
            searchName = searchName.trim().toLowerCase();
            item_array = item_array.filter(function (item) {
                if (item.name.toLowerCase().indexOf(searchName) !== -1 || item.description.toLowerCase().indexOf(searchName) !== -1) {
                    return item;
                }
            });

            //Return an array with the filtered data.
            return item_array;
        }
    },
    created(){
        this.fetchItems(this.pagination.current_page);
    },
    methods: {
        fetchItems (page)
        {
            this.$http.get('/api/admin/modules/business-types?page=' + page).then((response) => {
                this.items = response.data.data;
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
    },
    // filters: {
    //     truncate: function (text, length, clamp) {
    //         clamp = clamp || '...';
    //         let node = document.createElement('div');
    //         node.innerHTML = text;
    //         let content = node.textContent;
    //         return content.length > length ? content.slice(0, length) + clamp : content;
    //     }
    //
    // }
});
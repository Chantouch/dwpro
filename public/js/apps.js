/**
 * Created by Chantouch on 3/3/2017.
 */
Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("content");
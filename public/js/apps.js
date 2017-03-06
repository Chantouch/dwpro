/**
 * Created by Chantouch on 3/3/2017.
 */
Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("content");
// Filter for cutting off strings that are too long.
Vue.filter('truncate', function (value) {
    let length = 100;

    if (value.length <= length) {
        return value;
    }
    else {
        return value.substring(0, length) + '...';
    }
});

Vue.filter('dateshow', function (value) {
    return moment(value).fromNow();
});
/**
 * Created by Chantouch on 3/3/2017.
 */
Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("content");

// Filter for cutting off strings that are too long.
Vue.filter('truncate', function (value) {
    let length = 70;
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

Vue.filter('status', function (value) {
    if (value === 0) {
        return "Disabled";
    } else if (value === 1) {
        return 'Enabled';
    } else if (value === 2) {
        return 'Filled Up';
    } else {
        return 'Suspend';
    }
});

Vue.filter('gender', function (value) {
    if (value === "0") {
        return "Unspecified";
    } else if (value === "1") {
        return 'Male';
    } else if (value === "2") {
        return 'Female';
    } else {
        return 'Others';
    }
});

Vue.filter('count', function (value) {
    return value.length();
});
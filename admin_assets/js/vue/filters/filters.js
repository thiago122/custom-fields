Vue.filter('date', function (value, format) {
    if (!value) return ''
    return moment(value).format(format);
});

Vue.filter('time', function (value, format) {
    if (!value) return ''
    return moment('1970-01-01 ' + value).format(format);
});


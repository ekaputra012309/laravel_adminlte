$(document).ready(function() {
    var apiToken = $('meta[name="api-token"]').attr('content');
    console.log("API Token:", apiToken);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    console.log("CSRF Token:", csrfToken);
});

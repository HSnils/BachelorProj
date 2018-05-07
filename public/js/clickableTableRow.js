//if clicked on sends user to the link spesified
//usage: <tr class="clickable-row" data-href="LINK"></tr>
//uses the data href attribute as link
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
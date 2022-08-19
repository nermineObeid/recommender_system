jQuery( document ).ready(
    function () {
        jQuery('.sitemap').on('change', function (e) {
            var selectedCountry = $(this).children("option:selected").val();
            window.location.href=selectedCountry;

		});
        jQuery('.svg-nfLogo ').click(function () {
            alert('hi');
        });
    });
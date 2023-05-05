var gtag_val;
function loadDistributorDetail() {
    $.ajax({
        async: false,
        url: 'php/service-distributor/get-detail.php',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            if (response.status_code == 200) {
                var responseData = response.data;
                globalDistributorData = responseData;

                var primaryColor = (responseData.brand_colour != '')? responseData.brand_colour: '#d32f2e';
                var secondaryColor = (responseData.secondary_colour != '')? responseData.secondary_colour: '#d32f2e';
                var headerColor = (responseData.header_colour != '')? responseData.header_colour: '#d32f2e';
                var headerTextColor = (responseData.header_text_colour != '')? responseData.header_text_colour: '#d32f2e';
                var bannerImage = (responseData.banner_image != '')? responseData.banner_image: '';
                var posterImage = (responseData.poster_image != '')? responseData.poster_image: '';

                sessionStorage.setItem("header_logo", responseData.header_logo);
                $('.login-logo').attr("src", responseData.header_logo);

                var docTitle = document.title;
                docTitle = docTitle.replace("Home", responseData.name +' | Home');
                document.title = docTitle;
                
                if (document.getElementById('desc-distributor')) document.getElementById('desc-distributor').textContent = responseData.name;
                if (document.getElementById('footer-distributor')) document.getElementById('footer-distributor').textContent = responseData.name;
                if (document.getElementById('menu-distributor')) document.getElementById('menu-distributor').textContent = responseData.name;
                if (document.getElementById('header-logo')) document.getElementById('header-logo').src = responseData.header_logo;
                if (document.getElementById('favicon-logo')) document.getElementById('favicon-logo').href = responseData.favicon_logo;
                if(document.getElementById('footer-logo')) document.getElementById('footer-logo').src = responseData.footer_logo;
                if (document.getElementById('gtag_id')) document.getElementById('gtag_id').value = responseData.gtag_id;
                document.documentElement.style.setProperty('--color-primary', primaryColor);
                document.documentElement.style.setProperty('--header-color', headerColor);
                document.documentElement.style.setProperty('--header-text-color', headerTextColor);
                document.documentElement.style.setProperty('--secondary-color', secondaryColor);
                if (document.getElementById('header-logo1')) document.getElementById('header-logo1').src = responseData.header_logo;
                if (document.getElementsByClassName('login-logo')) {
                    document.getElementsByClassName('login-logo').src = responseData.header_logo;
                } else {
                    console.log('err');
                    console.log(responseData.header_logo);
                }
                if(document.getElementById('banner')) document.getElementById('banner').style.backgroundImage = "url('" + bannerImage + "')";
                $('#banner_description').html('<h3>' + responseData.description + '</h3>');
                if(document.getElementById('poster-img')) document.getElementById('poster-img').src = posterImage;

                gtag_val = $("#gtag_id").val();
                let pathtoscript = "https://www.googletagmanager.com/gtag/js?id="+gtag_val;
                // call the function...
                loadScript(pathtoscript, function() {
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());
                    gtag('config', gtag_val);
                });
            } else {
                swal('', "Invalid distributor !", "error");
                window.location.href = "404.php";
            }
            setTimeout(function() { $('#loading').fadeOut(); }, 500 );
        }
    });
}

function loadScript( url, callback ) {
    var script = document.createElement( "script" )
    script.type = "text/javascript";
    if(script.readyState) {  // only required for IE <9
        script.onreadystatechange = function() {
            if ( script.readyState === "loaded" || script.readyState === "complete" ) {
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function() {
            callback();
        };
    }
    script.src = url;
    document.getElementsByTagName( "head" )[0].appendChild( script );
}
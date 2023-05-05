<?php
    session_start();
    include_once '../config/core.php';
    if(isset($_COOKIE['azAdmin_Token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png" />
    <!-- bootstrap css  -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    />
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css" />
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/mediaquery.css" />
    <link rel="stylesheet" href="css/custom-table.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">

   
  </head>
  <body>
  <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header"></header>
    <main class="home-main">
      <section>
        <div class="flex-grid">
          <div class="flex-box" data-value="user-list">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/Donation Management.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>User Management</span>
            </div>
          </div>
          <div class="flex-box" data-value="Service-Provider">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/Campaign & Pot Management.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>Service Provider Management</span>
            </div>
          </div>
          <div class="flex-box" data-value="Service-Distributor">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/Community Management.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>Service Distributor Management</span>
            </div>
          </div>
          <div class="flex-box" data-value="service_list">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/Donation Management.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>Master Data Management</span>
            </div>
          </div>
            <!-- <div class="flex-box" data-value="under-construction.html">
                    <div class="home-widget-box">
                        <img src="./assets_new/home-page/Commission Management.png" class="home-widget" alt="">
                    </div>
                    <div class="module-box">
                        <span>Finance  Management</span>
                    </div>
                </div> -->
          <!-- <div class="flex-box" data-value="under-construction.html">
                    <div class="home-widget-box">
                        <img src="./assets_new/home-page/Banner Management.png" class="home-widget" alt="">
                    </div>
                    <div class="module-box">
                        <span>Booking Management</span>
                    </div>
                </div> -->
          <!-- <div class="flex-box" data-value="under-construction">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/Testimonial Management.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>Finance Management</span>
            </div>
          </div> -->
          <!-- <div class="flex-box" data-value="">
                    <div class="home-widget-box">
                        <img src="./assets_new/home-page/User Based Roles and Access.png" class="home-widget" alt="">
                    </div>
                    <div class="module-box">
                        <span>Notification Management</span>
                    </div>
                </div> -->
          <div class="flex-box" data-value="user-role-list">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/User Based Roles and Access.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>User Based Roles and Access</span>
            </div>
          </div>
          <div class="flex-box" data-value="booking-management">
            <div class="home-widget-box">
              <img src="./assets_new/home-page/User Based Roles and Access.png" class="home-widget" alt=""/>
            </div>
            <div class="module-box">
              <span>Booking Management</span>
            </div>
          </div>
          <div class="flex-box" data-value="web-banner">
            <div class="home-widget-box">
              <img src="./assets_new/home-page/Reports and Analytics.png" class="home-widget" alt=""/>
            </div>
            <div class="module-box">
              <span>Branch Management</span>
            </div>
          </div>
          <!-- <div class="flex-box" data-value="under-construction">
            <div class="home-widget-box">
              <img
                src="./assets_new/home-page/Reports and Analytics.png"
                class="home-widget"
                alt=""
              />
            </div>
            <div class="module-box">
              <span>Reports and Analytics</span>
            </div>
          </div> -->
          <!--  <div class="flex-box" data-value="">
                    <div class="home-widget-box">
                        <img src="./assets_new/home-page/Reports and Analytics.png" class="home-widget" alt="">
                    </div>
                    <div class="module-box">
                        <span>Feedback Management</span>
                    </div>
                </div> -->

          <!--     <div class="flex-box" data-value="under-construction.html">
                    <div class="home-widget-box">
                        <img src="./assets_new/home-page/Legal and Settings.png" class="home-widget" alt="">
                    </div>
                    <div class="module-box">
                        <span>Legal and Settings</span>
                    </div>
                </div> -->
        </div>
      </section>
    </main>
    <script src="js/jquery.min.js"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      
    </script>
   <script>
     var apiPath = "<?php echo $apiPath; ?>";

    $(document).ready(() => {
        fetchmodules();
       
        
        
    });

    function fetchmodules(){
      let moduleTokenArray = [];
      let availablemodules = '';

      let datas = {
                "adminToken":adminToken
            };
      let json1 = JSON.stringify(datas);
              $.ajax({
              dataType: "JSON",
              type: "POST",
              url: apiPath+"/admin/userModules.php",
              data: json1
              }).done(function(data) {
                let moduleArray = data.data;
                moduleArray.forEach((module,index) => {
                  moduleTokenArray.push(module.userToken);

                  
                });

                if(moduleTokenArray.includes('7J9L436Q3C')){
                  availablemodules += `<div class="flex-box" data-value="user-list">
                                      <div class="home-widget-box">
                                        <img
                                          src="./assets_new/home-page/Donation Management.png"
                                          class="home-widget"
                                          alt=""
                                        />
                                      </div>
                                      <div class="module-box">
                                        <span>User Management</span>
                                      </div>
                                    </div>`;

                }
                if(moduleTokenArray.includes('SFFVX3HXS0')){
                  availablemodules += `<div class="flex-box" data-value="Service-Provider">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/Campaign & Pot Management.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>Service Provider Management</span>
                                        </div>
                                      </div>` 
                }
                if(moduleTokenArray.includes('FW0HI5QYKX')){
                  availablemodules += ` <div class="flex-box" data-value="Service-Distributor">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/Community Management.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>Service Distributor Management</span>
                                        </div>
                                      </div>`;
                  
                }
                if(moduleTokenArray.includes('2WQPII20JY')){
                  availablemodules += `<div class="flex-box" data-value="service_list">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/Donation Management.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>Master Data Management</span>
                                        </div>
                                      </div>`;
                }
                if(moduleTokenArray.includes('XBWS9JDN20')){
                  availablemodules += `<div class="flex-box" data-value="under-construction" hidden>
                                          <div class="home-widget-box">
                                            <img
                                              src="./assets_new/home-page/Testimonial Management.png"
                                              class="home-widget"
                                              alt=""
                                            />
                                          </div>
                                          <div class="module-box">
                                            <span>Finance Management</span>
                                          </div>
                                        </div> `;
                  
                }
                if(moduleTokenArray.includes('G2IJV0MALZ')){
                  availablemodules +=  `<div class="flex-box" data-value="user-role-list.php">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/User Based Roles and Access.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>User Based Roles and Access</span>
                                        </div>
                                      </div>`;
                }
                if(moduleTokenArray.includes('8SG7NF6HR6')){
                  availablemodules += `<div class="flex-box" data-value="booking-management">
                                          <div class="home-widget-box">
                                            <img src="./assets_new/home-page/booking-management.svg" class="home-widget" alt=""/>
                                          </div>
                                          <div class="module-box">
                                            <span>Booking Management</span>
                                          </div>
                                      </div>`;
                }
                if(moduleTokenArray.includes('8SG7NF6HRJ')){
                  availablemodules += `<div class="flex-box" data-value="reports">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/Reports and Analytics.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>Report Management</span>
                                        </div>
                                      </div>`;
                }
                if(moduleTokenArray.includes('4KGCQBI4XA')){
                  availablemodules += `<div class="flex-box" data-value="coupon_list">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/Donation Management.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>Coupon Management</span>
                                        </div>
                                      </div>`;
                }  
                if(moduleTokenArray.includes('4A44913E56')){
                  availablemodules += `<div class="flex-box " data-value="web-banner">
                                        <div class="home-widget-box">
                                          <img
                                            src="./assets_new/home-page/Donation Management.png"
                                            class="home-widget"
                                            alt=""
                                          />
                                        </div>
                                        <div class="module-box">
                                          <span>Branding Management</span>
                                        </div>
                                      </div>`;
                }  
                
                $('.flex-grid').html(availablemodules);
                $(".flex-box").on("click", function () {
                var url_link = $(this).attr("data-value");
                window.open(url_link, "_self");
              });
              $("#loading").hide(); //Main Loader Close 
              })
    }
   </script>
  </body>
</html>
<?php
}
?>
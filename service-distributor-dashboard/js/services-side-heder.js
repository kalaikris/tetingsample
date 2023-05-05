const header_sidebar= ()=>{
    let header = `
             <div class="nav-header">
                <div class="logo-set">
                    <img src="./asset/img/logo.png" alt="logo" class="header-logo">
                   
                </div>
                <div class="profile-logout-set">
                    <ul class="nav-list-set">
                        <li class="relet-notif">
                            <a href="#">
                                <img src="./asset/notification_icon.svg" alt=""
                                    class="home-icon" />
                                
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="./asset/user1.png" alt=""
                                    class="user-icon" />
                            </a>
                        </li>
                        <li>
                            <select name="" id="top_select">
                                <option value="Randy Blair">Randy Blair</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
    `; 
    let sidebar = `
            <div class="siider-bg">
                        <div class="container-set">
                            <div class="profile-air">
                                <div class="red-circule">
                                   <img src="./asset/img/sid-logo.png" alt="" class="circule-img">
                                </div>
                                <select name="" class="option">
                                    <option value="pranaam">Pranaam</option>
                                </select>
                                <p class="meet-greet">Meet and Greet</p>
                                
                            </div>
                        </div>
                        <ul class="side-nav-list">
                            <li id="dashboard" class="nav-item nav-li">
                              
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/about us@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Dashboard</p>
                                    
                                </a>
                            </li>
                            <li id="booking_order" class="nav-item  nav-li">
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/faq@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Bookiong Orders</p>
                                    
                                </a>
                            </li>
                            <li id="my-staffs" class="nav-item nav-li">
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/privacy policy@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">My Staffs</p>
                                      
                                </a>
                            </li>
                              <li id="service-policies" class="nav-item nav-li">
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/privacy policy@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Services and policies</p>
                                      
                                </a>
                            </li>
                            <li id="management-inventory" class="nav-item nav-li">
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/terms and conditions@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Manage Inventory</p>
                                    
                                </a>
                            </li>
                            <li id="Manage-finance" class="nav-item nav-li">
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/terms and conditions@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Manage Finance</p>
                                    <div class="bule-line"></div>
                                </a>
                            </li>
                            <li id="Reports-analytics" class="nav-item nav-li">
                                <a href="#" class="nav-link">
                                    <img
                                        src="./asset/svg/privacy policy@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Reports and Analytics</p>
                                    
                                </a>
                            </li>
                            <li id="user-access" class="nav-item nav-li">
                                <a href="" class="nav-link">
                                    <img
                                        src="./asset/svg/privacy policy@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">User roles and access</p>
                                    
                                </a>
                            </li>
                        </ul>
                        <ul class="silder-set-help">
                             <li id="helpe" class="nav-item bottom-help">
                                <a href="#" class="nav-link">
                                    <img
                                        src="./asset/svg/terms and conditions@2x.png"
                                        class="side-icon"
                                        alt=""
                                        />
                                    <p class="icon-desc">Help</p>
                                </a>
                            </li>
                        </ul>
                    
                    </div>
    `;

    $('#header').html(header);
    $('#sidebar').html(sidebar);

}
header_sidebar();
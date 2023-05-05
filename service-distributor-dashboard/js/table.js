// tab conspt
    $(document).ready(function () {
                $("ul.tabs li").click(function () {
                    var tab_id = $(this).attr("data-tab");

                    $("ul.tabs li").removeClass("current");
                    $(".tab-content").removeClass("current");

                    $(this).addClass("current");
                    $("#" + tab_id).addClass("current");

                    // adjust table width on clicking tabs
                    $( $.fn.dataTable.tables( true ) ).DataTable().columns.adjust();
                });
            });

// table one

   $(document).ready(function () {
                $("#example2").DataTable({
                    language: {
                        search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                        searchPlaceholder: "Search...",
                    },
                    buttons: [
                        {
                            extend: "searchBuilder",
                            config: {
                                depthLimit: 2,
                            },
                        },
                    ],
                    dom: "Bfrtip",
                    columnDefs: [
                        {
                            type: "unknownType",
                            targets: [3],
                        },
                    ],
                });
   });
            
//    table two

         $(document).ready(function () {
                $("#example3").DataTable({
                    language: {
                        search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                        searchPlaceholder: "Search...",
                    },
                    buttons: [
                        {
                            extend: "searchBuilder",
                            config: {
                                depthLimit: 2,
                            },
                        },
                    ],
                    dom: "Bfrtip",
                    columnDefs: [
                        {
                            type: "unknownType",
                            targets: [3],
                        },
                    ],
                });
         });
            
         

      
// class call

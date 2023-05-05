$(document).ready(function () {
    // $(".chzn-select").chosen({ allow_single_deselect: true });
    // var secured = "secured";
    // var datas = { securedairportzo: secured };
    // var jsondata1 = JSON.stringify(datas);
    // $.ajax({
    //   type: "POST",
    //   dataType: "json",
    //   url: "../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
    //   data: jsondata1,
    // }).done(function (data) {
    //   $("#businessType").empty();
    //   var businessTypeData = data.business_type;
    //   var businesstypedata =
    //     '<option value="">Select Your Business Type</option>';
    //   for (var key in businessTypeData) {
    //     businesstypedata +=
    //       '<option value="' +
    //       businessTypeData[key].business_type_token +
    //       '">' +
    //       businessTypeData[key].business_name +
    //       "</option>";
    //   }
    //   $("#businessType").html(businesstypedata);
    //   $("#businessType")
    //     .change(function () {})
    //     .chosen({ allow_single_deselect: true });
    //   ({
    //     width: "100%",
    //     filter: true,
    //   });
    // });
  
    // $.ajax({
    //   type: "POST",
    //   dataType: "json",
    //   url: "../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
    //   data: jsondata1,
    // }).done(function (data) {
    //   $("#select_Country").empty();
    //   var countrytypedata = data.country_list;
    //   var countrydata = '<option value="">Select Your Country</option>';
    //   for (var key in countrytypedata) {
    //     countrydata +=
    //       '<option value="' +
    //       countrytypedata[key].country_id +
    //       '">' +
    //       countrytypedata[key].country_name +
    //       "</option>";
    //   }
    //   $("#select_Country").html(countrydata);
    //   $("#select_Country")
    //     .change(function () {})
    //     .chosen({ allow_single_deselect: true });
    //   ({
    //     width: "100%",
    //     filter: true,
    //   });
    // });

    // var countryidd = $("#select_Country").val();
    // var datas = { countryId: countryidd };
    // var json1 = JSON.stringify(datas);
    // $.ajax({
    //   dataType: "JSON",
    //   type: "POST",
    //   url: "../service-provider-dashboard/"+apiPath + "/provider/statesOfCountry.php",
    //   data: json1,
    // }).done(function (data) {
    //   $("#select_State").empty();
    //   var statedata = '<option value="">Select Your State</option>';
    //   var data = data.states;
    //   for (var key in data) {
    //     statedata +=
    //       '<option value="' +
    //       data[key].stateId +
    //       '">' +
    //       data[key].stateName +
    //       "</option>";
    //   }
    //   $("#select_State")
    //     .change(function () {})
    //     .chosen({ allow_single_deselect: true });
    //   ({
    //     width: "100%",
    //     filter: true,
    //   });
    // });

    // var countryidd = $("#select_Country").val();
    // var stateidd = $("#select_State").val();
    // var datas = { countryId: countryidd, stateId: stateidd };
    // var Jsondata = JSON.stringify(datas);
    // $.ajax({
    //   dataType: "JSON",
    //   type: "POST",
    //   url: "../service-provider-dashboard/"+apiPath + "/provider/citiesOfState.php",
    //   data: Jsondata,
    // }).done(function (data) {
    //   $("#select_City").empty();
    //   var citydata = '<option value="">Select Your City</option>';
    //   var data = data.cities;
    //   for (var key in data) {
    //     citydata +=
    //       '<option value="' +
    //       data[key].cityId +
    //       '">' +
    //       data[key].cityName +
    //       "</option>";
    //   }
    //   $("#select_City")
    //     .change(function () {})
    //     .chosen({ allow_single_deselect: true });
    //   ({
    //     width: "100%",
    //     filter: true,
    //   });   
    // });
  
    // $.ajax({
    //   type: "POST",
    //   dataType: "json",
    //   url: "../../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
    //   data: jsondata1,
    // }).done(function (data) {
    //   $("#AirportName").empty();
    //   var airportnamedata = data.airport_list;
    //   airportdata = '<option value="">Select Your Airport</option>';
    //   for (var key in airportnamedata) {
    //     airportdata +=
    //       '<option value="' +
    //       airportnamedata[key].airport_token +
    //       '">' +
    //       airportnamedata[key].airport_name +
    //       "</option>";
    //   }
    //   $("#AirportName1").html(airportdata);
    //   // $("#AirportName1").change(function() {
    //   // }).chosen({allow_single_deselect:true});({
    //   //     width: '100%',
    //   //     filter: true
    //   // });
  
    //   //disable and enable airport on change
    //   $("#AirportName1")
    //     .change(function () {
    //       console.log(1);
    //       new_location_array.forEach((idval, index) => {
    //         if (1 != idval) {
    //           $(`#AirportName${idval} option`)
    //             .prop("disabled", false)
    //             .trigger("chosen:updated");
    //           new_location_array.forEach((balanceid, index) => {
    //             if (balanceid != 1 && balanceid != idval) {
    //               let otherSelectedValue = $("#AirportName" + balanceid).val();
    //               $(`#AirportName${idval} option[value='${otherSelectedValue}']`)
    //                 .prop("disabled", true)
    //                 .trigger("chosen:updated");
    //             }
    //           });
    //           console.log(idval);
  
    //           let optionValue = $("#AirportName1").val();
    //           $(`#AirportName${idval} option[value='${optionValue}']`)
    //             .prop("disabled", true)
    //             .trigger("chosen:updated");
    //         }
    //       });
    //     })
    //     .chosen({ allow_single_deselect: true });
    //   ({
    //     width: "100%",
    //     filter: true,
    //   });
    // });
  });
  
  function country_relatedstate() {
    var countryidd = $("#select_Country").val();
    var datas = { countryId: countryidd };
    var json1 = JSON.stringify(datas);
    $.ajax({
      dataType: "JSON",
      type: "POST",
      url: "../service-provider-dashboard/"+apiPath + "/provider/statesOfCountry.php",
      data: json1,
    }).done(function (data) {
      $("#select_State").empty();
      var statedata = '<option value="">Select Your State</option>';
      var data = data.states;
      for (var key in data) {
        statedata +=
          '<option value="' +
          data[key].stateId +
          '">' +
          data[key].stateName +
          "</option>";
      }
      $("#select_State").append(statedata).trigger("chosen:updated");
        state_val = true;
    });
  }
  
  function state_relatedcity() {
    var countryidd = $("#select_Country").val();
    var stateidd = $("#select_State").val();
    var datas = { countryId: countryidd, stateId: stateidd };
    var Jsondata = JSON.stringify(datas);
    $.ajax({
      dataType: "JSON",
      type: "POST",
      url: "../service-provider-dashboard/"+apiPath + "/provider/citiesOfState.php",
      data: Jsondata,
    }).done(function (data) {
      $("#select_City").empty();
      var citydata = '<option value="">Select Your City</option>';
      var data = data.cities;
      for (var key in data) {
        citydata +=
          '<option value="' +
          data[key].cityId +
          '">' +
          data[key].cityName +
          "</option>";
      }
      $("#select_City").append(citydata).trigger("chosen:updated");
        city_val = true;
    });
  }
  
// loadAsset = function(selector,jsAsset,myscript){
// 	if($(selector).length){
// 		$.when(
// 		    $.getScript(jsAsset[0]),
// 		    $.getScript(jsAsset[1]),
// 		    $.getScript(jsAsset[2]),
// 		    $.Deferred(function( deferred ){
// 		        $( deferred.resolve );
// 		    })
// 		).done(function(){	    	    
		    
// 			myscript();
// 		});
// 	}
// }
var yeplib = {
	path:{
		'select2':'select2/js/select2.min.js',
		'x_editable':'x-editable/js/bootstrap-editable.min.js',
		'mockjax':'jquery-mockjax/js/jquery.mockjax.min.js',
		'typeheadjs':'typeaheadjs/js/typeaheadjs.min.js',
		'typehead':'typeaheadjs/js/typeahead.min.js',
		'momentjs':'momentjs/js/moment.min.js'
	},
	css:{
		select2:'select2/css/select2.min.css',
		x_editable:'x-editable/css/bootstrap-editable.min.css'			
	},
	depend:{
		x_editable:['select2','momentjs','typehead','typeheadjs','mockjax']
	}

}
var base_url = '../assets/vendors/'
loadAsset = function(selector,Asset,script){
	//  Define jsAsset and cssAsset
	var jsAsset = [];
	var cssAsset = [];

	// fill value to jsAsset
	if(Asset.length){			
		for (q=0 ; q<Asset.length; q++){	

			if(yeplib.depend[Asset[q]].length){
				// fill value with own dependences
				jsDepends = yeplib.depend[Asset[q]];		
				for (z=0 ; z<jsDepends.length; z++){	
					// check is not null
					if(typeof(yeplib.path[jsDepends[z]]) != 'undefined'){
						jsAsset.push(yeplib.path[jsDepends[z]]);						
					}
					if(typeof(yeplib.css[jsDepends[z]]) != 'undefined'){						
						cssAsset.push(yeplib.css[jsDepends[z]]);						
					}
				}
			}		
			// fill value with own js
			jsAsset.push(yeplib.path[Asset[q]]);			
			cssAsset.push(yeplib.css[Asset[q]]);

		}
	}
	if($(selector).length){
		var promises=[];
		for (var i=0; i<jsAsset.length; i++){ 
		    var request= $.getScript(base_url+jsAsset[i]);
		   	promises.push( request);
		}
		if($(selector).length){
			$.when.apply($, promises).done(function(){	    	    

				// load css
				for (j=0; j<cssAsset.length; j++){
					$("head link[href='../assets/vendors/font-awesome/css/font-awesome.min.css'] ").last().after("<link rel='stylesheet' href='"+base_url+cssAsset[j]+"' >");
				}
			    // load script that related to js
				script();
				
			}).fail(function(){
				console.error('Some yep assets does not load');
			});
		}

	}	
}
//  version 1.0
// var base_url = '../assets/vendors/'
// loadAsset = function(selector,jsAsset,cssAsset,script){
// 	if($(selector).length){
// 		var promises=[];
// 		for (var i=0; i<jsAsset.length; i++){ 
// 		    var request= $.getScript(base_url+jsAsset[i]);
// 		   	promises.push( request);
// 		}
// 		if($(selector).length){
// 			$.when.apply($, promises).done(function(){	    	    
// 			    // load script that related to js
// 				script();

// 				// load css
// 				for (j=0; j<cssAsset.length; j++){
// 					$("head link[href='../assets/vendors/font-awesome/css/font-awesome.min.css'] ").last().after("<link rel='stylesheet' href='"+base_url+cssAsset[j]+"' >");
// 				}
// 			}).fail(function(){
// 				console.error('Some yep assets does not load');
// 			});
// 		}

// 	}	
// }


/*
 * Select2 initiate
 */
 // version 1.0 
 /*
var yep_select2 = function(){ 
	// Select Script
	$('.select2').select2({
		allowClear : true, 
		width : '100%'
	}); 
}
loadAsset('.select2', ['select2/js/select2.min.js'], ['select2/css/select2.min.css'], yep_select2 );
*/

/*
 * x-editable initiate 
 */
var yep_x_editable = function(){
	
		$('.select2').select2({
			allowClear : true, 
			width : '100%'
		}); 

		//ajax mocks
	    $.mockjaxSettings.responseTime = 250;
	
	    $.mockjax({
	        url: '/post',
	        response: function (settings) {
	            log(settings, this);
	        }
	    });
	
	    $.mockjax({
	        url: '/error',
	        status: 400,
	        statusText: 'Bad Request',
	        response: function (settings) {
	            this.responseText = 'Please input correct value';
	            log(settings, this);
	        }
	    });
	
	    $.mockjax({
	        url: '/status',
	        status: 500,
	        response: function (settings) {
	            this.responseText = 'Internal Server Error';
	            log(settings, this);
	        }
	    });
	
	    $.mockjax({
	        url: '/groups',
	        response: function (settings) {
	            this.responseText = [{
	                value: 0,
	                text: 'Guest'
	            }, {
	                value: 1,
	                text: 'Service'
	            }, {
	                value: 2,
	                text: 'Customer'
	            }, {
	                value: 3,
	                text: 'Operator'
	            }, {
	                value: 4,
	                text: 'Support'
	            }, {
	                value: 5,
	                text: 'Admin'
	            }];
	           log(settings, this);
	        }
	    });

 	//defaults
    $.fn.editable.defaults.url = '/post';
    $.fn.editable.defaults.mode = 'inline'; //use this to edit inline

    //enable / disable
    $('#enable').click(function () {
        $('#user .editable').editable('toggleDisabled');
    });

    //editables
    $('#username').editable({
        url: '/post',
        type: 'text',
        pk: 1,
        name: 'username',
        title: 'Enter username'
    });

    $('#firstname').editable({
        validate: function (value) {
            if ($.trim(value) == '')
                return 'This field is required';
        }
    });

    $('#sex').editable({
        prepend: "not selected",
        source: [{
            value: 1,
            text: 'Male'
        }, {
            value: 2,
            text: 'Female'
        }],
        display: function (value, sourceData) {
            var colors = {
                "": "gray",
                1: "green",
                2: "blue"
            }, elem = $.grep(sourceData, function (o) {
                    return o.value == value;
                });

            if (elem.length) {
                $(this).text(elem[0].text).css("color", colors[value]);
            } else {
                $(this).empty();
            }
        }
    });

    $('#status').editable();

    $('#group').editable({
        showbuttons: false
    });

    $('#vacation').editable({
        datepicker: {
            todayBtn: 'linked'
        }
    });

    $('#dob').editable();

    $('#event').editable({
        placement: 'right',
        combodate: {
            firstItem: 'name'
        }
    });

    $('#meeting_start').editable({
        format: 'yyyy-mm-dd hh:ii',
        viewformat: 'dd/mm/yyyy hh:ii',
        validate: function (v) {
            if (v && v.getDate() == 10)
                return 'Day cant be 10!';
        },
        datetimepicker: {
            todayBtn: 'linked',
            weekStart: 1
        }
    });

    $('#comments').editable({
        showbuttons: 'bottom'
    });

    $('#note').editable();
    $('#pencil').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
    });

    $('#state').editable({
        source: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut",
            "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas",
            "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota",
            "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey",
            "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon",
            "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas",
            "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"
        ]
    });

    $('#state2').editable({
        value: 'California',
        typeahead: {
            name: 'state',
            local: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut",
                "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa",
                "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan",
                "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire",
                "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio",
                "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
                "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia",
                "Wisconsin", "Wyoming"
            ]
        }
    });

    $('#fruits').editable({
        pk: 1,
        limit: 3,
        source: [{
            value: 1,
            text: 'banana'
        }, {
            value: 2,
            text: 'peach'
        }, {
            value: 3,
            text: 'apple'
        }, {
            value: 4,
            text: 'watermelon'
        }, {
            value: 5,
            text: 'orange'
        }]
    });

    $('#tags').editable({
        inputclass: 'input-large',
        select2: {
            tags: ['html', 'javascript', 'css', 'ajax'],
            tokenSeparators: [",", " "]
        }
    });

    var countries = [];
    $.each({
        "BD": "Bangladesh",
        "BE": "Belgium",
        "BF": "Burkina Faso",
        "BG": "Bulgaria",
        "BA": "Bosnia and Herzegovina",
        "BB": "Barbados",
        "WF": "Wallis and Futuna",
        "BL": "Saint Bartelemey",
        "BM": "Bermuda",
        "BN": "Brunei Darussalam",
        "BO": "Bolivia",
        "BH": "Bahrain",
        "BI": "Burundi",
        "BJ": "Benin",
        "BT": "Bhutan",
        "JM": "Jamaica",
        "BV": "Bouvet Island",
        "BW": "Botswana",
        "WS": "Samoa",
        "BR": "Brazil",
        "BS": "Bahamas",
        "JE": "Jersey",
        "BY": "Belarus",
        "O1": "Other Country",
        "LV": "Latvia",
        "RW": "Rwanda",
        "RS": "Serbia",
        "TL": "Timor-Leste",
        "RE": "Reunion",
        "LU": "Luxembourg",
        "TJ": "Tajikistan",
        "RO": "Romania",
        "PG": "Papua New Guinea",
        "GW": "Guinea-Bissau",
        "GU": "Guam",
        "GT": "Guatemala",
        "GS": "South Georgia and the South Sandwich Islands",
        "GR": "Greece",
        "GQ": "Equatorial Guinea",
        "GP": "Guadeloupe",
        "JP": "Japan",
        "GY": "Guyana",
        "GG": "Guernsey",
        "GF": "French Guiana",
        "GE": "Georgia",
        "GD": "Grenada",
        "GB": "United Kingdom",
        "GA": "Gabon",
        "SV": "El Salvador",
        "GN": "Guinea",
        "GM": "Gambia",
        "GL": "Greenland",
        "GI": "Gibraltar",
        "GH": "Ghana",
        "OM": "Oman",
        "TN": "Tunisia",
        "JO": "Jordan",
        "HR": "Croatia",
        "HT": "Haiti",
        "HU": "Hungary",
        "HK": "Hong Kong",
        "HN": "Honduras",
        "HM": "Heard Island and McDonald Islands",
        "VE": "Venezuela",
        "PR": "Puerto Rico",
        "PS": "Palestinian Territory",
        "PW": "Palau",
        "PT": "Portugal",
        "SJ": "Svalbard and Jan Mayen",
        "PY": "Paraguay",
        "IQ": "Iraq",
        "PA": "Panama",
        "PF": "French Polynesia",
        "BZ": "Belize",
        "PE": "Peru",
        "PK": "Pakistan",
        "PH": "Philippines",
        "PN": "Pitcairn",
        "TM": "Turkmenistan",
        "PL": "Poland",
        "PM": "Saint Pierre and Miquelon",
        "ZM": "Zambia",
        "EH": "Western Sahara",
        "RU": "Russian Federation",
        "EE": "Estonia",
        "EG": "Egypt",
        "TK": "Tokelau",
        "ZA": "South Africa",
        "EC": "Ecuador",
        "IT": "Italy",
        "VN": "Vietnam",
        "SB": "Solomon Islands",
        "EU": "Europe",
        "ET": "Ethiopia",
        "SO": "Somalia",
        "ZW": "Zimbabwe",
        "SA": "Saudi Arabia",
        "ES": "Spain",
        "ER": "Eritrea",
        "ME": "Montenegro",
        "MD": "Moldova, Republic of",
        "MG": "Madagascar",
        "MF": "Saint Martin",
        "MA": "Morocco",
        "MC": "Monaco",
        "UZ": "Uzbekistan",
        "MM": "Myanmar",
        "ML": "Mali",
        "MO": "Macao",
        "MN": "Mongolia",
        "MH": "Marshall Islands",
        "MK": "Macedonia",
        "MU": "Mauritius",
        "MT": "Malta",
        "MW": "Malawi",
        "MV": "Maldives",
        "MQ": "Martinique",
        "MP": "Northern Mariana Islands",
        "MS": "Montserrat",
        "MR": "Mauritania",
        "IM": "Isle of Man",
        "UG": "Uganda",
        "TZ": "Tanzania, United Republic of",
        "MY": "Malaysia",
        "MX": "Mexico",
        "IL": "Israel",
        "FR": "France",
        "IO": "British Indian Ocean Territory",
        "FX": "France, Metropolitan",
        "SH": "Saint Helena",
        "FI": "Finland",
        "FJ": "Fiji",
        "FK": "Falkland Islands (Malvinas)",
        "FM": "Micronesia, Federated States of",
        "FO": "Faroe Islands",
        "NI": "Nicaragua",
        "NL": "Netherlands",
        "NO": "Norway",
        "NA": "Namibia",
        "VU": "Vanuatu",
        "NC": "New Caledonia",
        "NE": "Niger",
        "NF": "Norfolk Island",
        "NG": "Nigeria",
        "NZ": "New Zealand",
        "NP": "Nepal",
        "NR": "Nauru",
        "NU": "Niue",
        "CK": "Cook Islands",
        "CI": "Cote d'Ivoire",
        "CH": "Switzerland",
        "CO": "Colombia",
        "CN": "China",
        "CM": "Cameroon",
        "CL": "Chile",
        "CC": "Cocos (Keeling) Islands",
        "CA": "Canada",
        "CG": "Congo",
        "CF": "Central African Republic",
        "CD": "Congo, The Democratic Republic of the",
        "CZ": "Czech Republic",
        "CY": "Cyprus",
        "CX": "Christmas Island",
        "CR": "Costa Rica",
        "CV": "Cape Verde",
        "CU": "Cuba",
        "SZ": "Swaziland",
        "SY": "Syrian Arab Republic",
        "KG": "Kyrgyzstan",
        "KE": "Kenya",
        "SR": "Suriname",
        "KI": "Kiribati",
        "KH": "Cambodia",
        "KN": "Saint Kitts and Nevis",
        "KM": "Comoros",
        "ST": "Sao Tome and Principe",
        "SK": "Slovakia",
        "KR": "Korea, Republic of",
        "SI": "Slovenia",
        "KP": "Korea, Democratic People's Republic of",
        "KW": "Kuwait",
        "SN": "Senegal",
        "SM": "San Marino",
        "SL": "Sierra Leone",
        "SC": "Seychelles",
        "KZ": "Kazakhstan",
        "KY": "Cayman Islands",
        "SG": "Singapore",
        "SE": "Sweden",
        "SD": "Sudan",
        "DO": "Dominican Republic",
        "DM": "Dominica",
        "DJ": "Djibouti",
        "DK": "Denmark",
        "VG": "Virgin Islands, British",
        "DE": "Germany",
        "YE": "Yemen",
        "DZ": "Algeria",
        "US": "United States",
        "UY": "Uruguay",
        "YT": "Mayotte",
        "UM": "United States Minor Outlying Islands",
        "LB": "Lebanon",
        "LC": "Saint Lucia",
        "LA": "Lao People's Democratic Republic",
        "TV": "Tuvalu",
        "TW": "Taiwan",
        "TT": "Trinidad and Tobago",
        "TR": "Turkey",
        "LK": "Sri Lanka",
        "LI": "Liechtenstein",
        "A1": "Anonymous Proxy",
        "TO": "Tonga",
        "LT": "Lithuania",
        "A2": "Satellite Provider",
        "LR": "Liberia",
        "LS": "Lesotho",
        "TH": "Thailand",
        "TF": "French Southern Territories",
        "TG": "Togo",
        "TD": "Chad",
        "TC": "Turks and Caicos Islands",
        "LY": "Libyan Arab Jamahiriya",
        "VA": "Holy See (Vatican City State)",
        "VC": "Saint Vincent and the Grenadines",
        "AE": "United Arab Emirates",
        "AD": "Andorra",
        "AG": "Antigua and Barbuda",
        "AF": "Afghanistan",
        "AI": "Anguilla",
        "VI": "Virgin Islands, U.S.",
        "IS": "Iceland",
        "IR": "Iran, Islamic Republic of",
        "AM": "Armenia",
        "AL": "Albania",
        "AO": "Angola",
        "AN": "Netherlands Antilles",
        "AQ": "Antarctica",
        "AP": "Asia/Pacific Region",
        "AS": "American Samoa",
        "AR": "Argentina",
        "AU": "Australia",
        "AT": "Austria",
        "AW": "Aruba",
        "IN": "India",
        "AX": "Aland Islands",
        "AZ": "Azerbaijan",
        "IE": "Ireland",
        "ID": "Indonesia",
        "UA": "Ukraine",
        "QA": "Qatar",
        "MZ": "Mozambique"
    }, function (k, v) {
        countries.push({
            id: k,
            text: v
        });
    });

    $('#country').editable({
        source: countries,
        select2: {
            width: 200
        }
    });

   
	 $('#address').editable({
        url: '/post',
        value: {
            city: "Moscow",
            street: "Lenina",
            building: "12"
        },
        validate: function (value) {
            if (value.city == '')
                return 'city is required!';
        },
        display: function (value) {
            if (!value) {
                $(this).empty();
                return;
            }
            var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street)
                .html() + ' st., bld. ' + $('<div>').text(value.building).html();
            $(this).html(html);
        }
    });
}
loadAsset('#username',['x_editable'],yep_x_editable);
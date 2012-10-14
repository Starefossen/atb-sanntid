var map;

!function( $ ){
	
	"use strict"
	
	var settings = {
		'result' : $('#result'),
	};
	
	var items = new Array();
	var route = {
		// 
		'14' : new Array(100402, 100509, 100510, 100928, 101248, 101360, 100199, 101766, 100390, 101353, 100108, 100107, 101247, 101133),
		'66' : new Array(100390, 101644, 101767, 100493, 100950, 100929, 100510,  100509, 100407),
		'155' : new Array(100271, 100402, 100509, 100510, 100928, 101248, 101360, 100199, 101766, 100390)
	};
	var bus = {
		'comp' : 1,
		'line' : 14,
		'path' : 185,
		'stop' : 0,
		
		'last' : null,
		'current' : null,
		'stopData' : null,
		
		'interval' : null,
		
		'title' : '5 til Dragvoll'
	}
	var map = {
		'map' : null,
		'lastStop' : null,
		'nextStop' : null,
		'circleIn' : null,
		'circleOu' : null,
		'info' : null
	}

	var methods = {
		
		list : function( ) {
			$.each(map['marker'].data('events'), function(i, e) {
			    console.log(i, e);
			});
		},
		
		
		/**
		 * Init method
		 */
		init : function( options ) {
			// Merge options with settings
			if ( options ) { $.extend( settings, options ); }
			
			$.fn.sanntid('track');
			$.fn.sanntid('mapInit', 'map_canvas');
		},
		
		mapInit : function( map_id ) {
			var stockholm = new google.maps.LatLng(63.429722, 10.393333);
			var parliament = new google.maps.LatLng(63.430638, 10.39307);
			
			map['info'] = new google.maps.InfoWindow({});
			
			var mapOptions = {
				zoom: 14,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				center: stockholm
			};
			
			map['map'] = new google.maps.Map(document.getElementById(map_id), mapOptions);
			
			var latLngA = new google.maps.LatLng(63.430638, 10.39307);
			var latLngB = new google.maps.LatLng(63.422664, 10.395227);
			var middle = $.fn.sanntid('getMiddle', latLngA, latLngB);
			
			var imageA = new google.maps.MarkerImage("markers/bus.green.png", new google.maps.Size(32, 37));
			var imageB = new google.maps.MarkerImage("markers/bus.stop.red.png", new google.maps.Size(32, 37));
			
			map['lastStop'] = new google.maps.Marker({map: map['map'],position: latLngA, icon: imageA, title: 'Last stop', visible: false});
			map['nextStop'] = new google.maps.Marker({map: map['map'],position: latLngB, icon: imageB, title: 'Next stop', visible: false});
			map['circleOu'] = new google.maps.Circle({map: map['map'], center: middle, radius: 0, fillColor: '#FF0000', fillOpacity: 0.2});
			map['circleIn'] = new google.maps.Circle({map: map['map'], center: middle, radius: 0, fillColor: '#4096EE', fillOpacity: 1});
			
			google.maps.event.addListener(map['marker'], 'click', function() {
				infowindow.open(map['marker'],map['marker']);
			});			
		},
		
		/**
		 * Get marker icon
		 */
		getIcon : function (color) {
			return MapIconMaker.createMarkerIcon({width: 20, height: 34, primaryColor: color, cornercolor:color});
		},
		
		/**
		 * Get middle of two markers
		 */
		getMiddle : function (latLngA, latLngB ) {
			var lat = (String) ((latLngA.lat()+latLngB.lat())/2).substring(0, 9);
			var lng = (String) ((latLngA.lng()+latLngB.lng())/2).substring(0, 9);
			var middle = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
			
			return middle;
		},
		
		/**
		 * Move map marker
		 *
		 * @param lat - 
		 * @param lng - 
		 */
		mapMarkerMove : function( lat, lng) {
			console.log('mapMarkerMove('+lat+', '+lng+')');			
			
			var lastStop = new google.maps.LatLng(lat, lng);			
			map['lastStop'].setPosition(lastStop);
			map['lastStop'].setVisible(true);
			map['map'].setCenter(lastStop);
			
			$.fn.sanntid('mapInfoUpdate');
		},
		
		/**
		 * 
		 */
		mapMarkersMove : function( lat, lng) {
			console.log('mapMarkersMove('+lat+', '+lng+')');			
			
			var nextStop = new google.maps.LatLng(lat, lng);
			var lastStop = new google.maps.LatLng(bus['stopInfo']['coordLat'], bus['stopInfo']['coordLon']);
			var middle = $.fn.sanntid('getMiddle', lastStop, nextStop);
			var radius = google.maps.geometry.spherical.computeDistanceBetween(nextStop, lastStop);
			
			map['nextStop'].setPosition(nextStop);
			map['lastStop'].setPosition(lastStop);
			map['circleOu'].setRadius(radius/2);
			map['circleOu'].setCenter(middle);
			map['circleIn'].setCenter(middle);
			map['map'].setCenter(middle);
			
			$.fn.sanntid('mapInfoUpdate');
		},
		
		/**
		 *
		 */
		mapMarkersSwitch : function( lat, lng) {
			console.log('mapMarkersSwitch()');
			
			var lastStopImg = new google.maps.MarkerImage("markers/bus.stop.green.png", new google.maps.Size(32, 37));
			
			map['nextStop'].setVisible(true);
			map['lastStop'].setIcon(lastStopImg);
			map['circleIn'].setRadius(20);
			
			$.fn.sanntid('mapMarkersMove', lat, lng);
		},	
		
		/**
		 * 
		 */
		mapInfoUpdate : function() {
			
			//if (bus[]
			
			/*
			var contentString = '<div id="content">'+
				'<div id="siteNotice">\n'+
				'<h1 id="firstHeading" class="firstHeading">'+bus['title']+'</h1>\n'+
				'<div id="bodyContent">\n'+
				'<p>Information comes here.</p>'+
				'</div>\n</div>\n';
							
			map['info'].setContent(contentString);
			*/
		},
		
		
		/**
		 * Start tracking a given bus
		 */
		track : function( ) {
			console.log('track(comp: '+bus['comp']+', line: '+bus['line']+', path: '+bus['path']+', stop: '+bus['stop']+')');
			
			var callback = function( data ) { 
				console.log(data);
				
				if (data == undefined || data['stop'] == undefined || data['total'] == 0) {
					console.log('stop "'+bus['stop']+'" returned "0" shceduled buses!');
					clearInterval(bus['interval']);
					alert("The bus has reached it'a destination!");
					
					return false;
				}
				
				var lat = data['stop'][0].coordLat;
				var lng = data['stop'][0].coordLon;
								
				bus['current'] = data['arrivals'][0];
				bus['current']['arrival'] = $.fn.sanntid('timeSlice', bus['current']['arrival']);
				bus['current']['arrival_new'] = $.fn.sanntid('timeSlice', bus['current']['arrival_new']);
				
				if (bus['last'] != null && bus['last']['arrival'] > bus['current']['arrival']) {
					console.log('Bus "'+bus['path']+'" has not yet left stop "'+bus['stop']+'"'); 
					
					if (bus['interval'] == null) {
						console.log('starting track interval');
						
						$.fn.sanntid('mapMarkersSwitch', lat, lng);
						
						bus['interval'] = setInterval(function() {
							console.log('running track interval');
							$.fn.sanntid('track');
						}, 20000);
					} else {
						$.fn.sanntid('mapMarkersMove', lat, lng);
					}
					
					return false;
				}
				
				if (bus['interval'] != null) {
					$.fn.sanntid('mapMarkersMove', lat, lng);
				}
				
				bus['stop']++;
				bus['stopInfo'] = data['stop'][0];
				bus['last'] = bus['current'];				
				
				if (bus['interval'] == null) {
					$.fn.sanntid('mapMarkerMove', lat, lng);
				}
				
				if (bus['stop'] > route[bus['line']].length) {
					alert("The bus has reached it'a destination!");
					clearInterval(bus['interval']);
				}
				
				if (bus['interval'] == null) {
					$.fn.sanntid('track');
				}
			};
			
			$.fn.sanntid('getSchedule', bus['comp'], bus['line'], route[bus['line']][bus['stop']], callback)
		},
		
		timeSlice : function( date ) {
			var time;
			
			date = date.split(' ');
			
			time = date[1];
			date = date[0];
			
			time = time.split(':');
			
			return time[0]+time[1];
		},
		
		/**
		 * Get stops for given line and path
		 *
		 * @param comp - unique company id
		 * @param line - unique line id
		 * @param path - unique line path id
		 * @param success - sucess function callback
		 */
		getStops : function( comp, line, path, success) {
			$.getJSON('privateApi.php?method=stops&company='+comp+'&line='+line+'&path='+path, success);
		},
		
		/**
		 * Get stops for given line and path
		 *
		 * @param comp - unique company id
		 * @param line - unique line id
		 * @param stop - unique stop id
		 * @param success - sucess function callback
		 */
		getSchedule : function( comp, line, stop, success) {
			$.getJSON('privateApi.php?method=schedule&company='+comp+'&line='+line+'&stop='+stop, success);
		}
	}
	
	/**
	 * Eta index method
	 *
	 * @param method - What method to invoke
	 */
	$.fn.sanntid = function( method ) {
	
		// Method calling logic
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on etaIndex' );
		}    
	
	};
}( window.jQuery || window.ender );
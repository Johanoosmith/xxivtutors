/*  @preserve
jQuery pub/sub plugin by Peter Higgins (dante@dojotoolkit.org)
Loosely based on Dojo publish/subscribe API, limited in scope. Rewritten blindly.
Original is (c) Dojo Foundation 2004-2010. Released under either AFL or new BSD, see:
http://dojofoundation.org/license for more information.
*/
(function($) {
	var topics = {};
	$.publish = function(topic, args) {
	    if (topics[topic]) {
	        var currentTopic = topics[topic],
	        args = args || {};
	
	        for (var i = 0, j = currentTopic.length; i < j; i++) {
	            currentTopic[i].call($, args);
	        }
	    }
	};
	$.subscribe = function(topic, callback) {
	    if (!topics[topic]) {
	        topics[topic] = [];
	    }
	    topics[topic].push(callback);
	    return {
	        "topic": topic,
	        "callback": callback
	    };
	};
	$.unsubscribe = function(handle) {
	    var topic = handle.topic;
	    if (topics[topic]) {
	        var currentTopic = topics[topic];
	
	        for (var i = 0, j = currentTopic.length; i < j; i++) {
	            if (currentTopic[i] === handle.callback) {
	                currentTopic.splice(i, 1);
	            }
	        }
	    }
	};


    $(document).ready(function() {
        
        // This is the part where jSignature is initialized.
        var $sigdiv = $("#signature").jSignature({'UndoButton':true})
        
        
        // All the code below is just code driving the demo. 
        , $tools = $('#tools')
        , $extraarea = $('#displayarea')
        , pubsubprefix = 'jSignature.demo.'
        
        var export_plugins = $sigdiv.jSignature('listPlugins','export')
        , chops = ['<span style="display:none"><b>Extract signature data as: </b></span><select style="display:none">','<option value="">(select export format)</option>']
        , name
        for(var i in export_plugins){
            if (export_plugins.hasOwnProperty(i)){
                name = export_plugins[i]
                chops.push('<option value="' + name + '">' + name + '</option>')
            }
        }
        chops.push('</select></span>')

        chops.push('<input type="button" id="GetImageData" class="btn btn-yellow" value="Confirm Signature" />')
        
        //$(chops.join('')).bind('change', function(e){
            $(chops.join('')).bind('click', function(e){
                
            //if (e.target.value !== ''){
                //var data = $sigdiv.jSignature('getData', e.target.value)
                var data = $sigdiv.jSignature('getData', 'default');
                
                $.publish(pubsubprefix + 'formatchanged')
                if (typeof data === 'string'){
                    $('textarea', $tools).val(data)
                } else if($.isArray(data) && data.length === 2){
                    $('textarea', $tools).val(data.join(','))
                    $.publish(pubsubprefix + data[0], data);
                } else {
                    try {
                        $('textarea', $tools).val(JSON.stringify(data))
                    } catch (ex) {
                        $('textarea', $tools).val('Not sure how to stringify this, likely binary, format.')
                    }
                }
            //}
        }).appendTo($tools)
    
        
        $('<input type="button" class="btn btn-danger" value="Reset">').bind('click', function(e){
            $sigdiv.jSignature('reset')
        }).appendTo($tools)
        
        $('<div><textarea name="signature" style="display:none;width:100%;height:7em;"></textarea></div>').appendTo($tools)
        
        $.subscribe(pubsubprefix + 'formatchanged', function(){
            $extraarea.html('')
        })
    
        $.subscribe(pubsubprefix + 'image/svg+xml', function(data) {
    
            try{
                var i = new Image()
                i.src = 'data:' + data[0] + ';base64,' + btoa( data[1] )
                $(i).appendTo($extraarea)
            } catch (ex) {
    
            }
            
            var message = [
                "If you don't see an image immediately above, it means your browser is unable to display in-line (data-url-formatted) SVG."
                , "This is NOT an issue with jSignature, as we can export proper SVG document regardless of browser's ability to display it."
                , "Try this page in a modern browser to see the SVG on the page, or export data as plain SVG, save to disk as text file and view in any SVG-capabale viewer."
               ]
            $( "<div>" + message.join("<br/>") + "</div>" ).appendTo( $extraarea )
        });
    
        $.subscribe(pubsubprefix + 'image/svg+xml;base64', function(data) {
            var i = new Image()
            i.src = 'data:' + data[0] + ',' + data[1]
            $(i).appendTo($extraarea)
            
            var message = [
                "If you don't see an image immediately above, it means your browser is unable to display in-line (data-url-formatted) SVG."
                , "This is NOT an issue with jSignature, as we can export proper SVG document regardless of browser's ability to display it."
                , "Try this page in a modern browser to see the SVG on the page, or export data as plain SVG, save to disk as text file and view in any SVG-capabale viewer."
               ]
            $( "<div>" + message.join("<br/>") + "</div>" ).appendTo( $extraarea )
        });
        
        $.subscribe(pubsubprefix + 'image/png;base64', function(data) {
            var i = new Image()
            i.src = 'data:' + data[0] + ',' + data[1]
            $('<span><b>As you can see, one of the problems of "image" extraction (besides not working on some old Androids, elsewhere) is that it extracts A LOT OF DATA and includes all the decoration that is not part of the signature.</b></span>').appendTo($extraarea)
            $(i).appendTo($extraarea)
        });
        
        $.subscribe(pubsubprefix + 'image/jsignature;base30', function(data) {
            $('<span><b>This is a vector format not natively render-able by browsers. Format is a compressed "movement coordinates arrays" structure tuned for use server-side. The bonus of this format is its tiny storage footprint and ease of deriving rendering instructions in programmatic, iterative manner.</b></span>').appendTo($extraarea)
        });
    
        // if (Modernizr.touch){
        //     $('#scrollgrabber').height($('#content').height())		
        // }
        
    })
    
    })(jQuery)



    /*
        Working on 
    
    */
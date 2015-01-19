(function($){
    //cache needed for overagressive garbage collectors.
    var cache = [];
    //images can either be an array of paths to images or a  single image. 
    $.loadImages = function(images, callback){
    
        // if our first argument is an string, we convert it to an array
        if (typeof images == "string") {
            images = [images];
        }
        
        var imagesLength = images.length;
        var loadedCounter = 0;
        
        for (var i = 0; i < imagesLength; i++) {
			var cacheImage = document.createElement('img');
			//set the onload method before the src is called otherwise will fail to be called in IE
            cacheImage.onload = function(){
                loadedCounter++;
                if (loadedCounter == imagesLength) {
                    if ($.isFunction(callback)) {
                        callback();
                    }
                }
            }
            cacheImage.src = images[i];
            cache.push(cacheImage);
        }
    }
})(jQuery)

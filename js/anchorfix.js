jQuery(document).ready(function() {
	var isScrollFix = false;
	document.getElementById('hold').addEventListener('scroll',function(e){
	        if(!isScrollFix) {//dont copy our own scroll event onto document
	              isScrollFix = true;
	              var scrollTo = this.scrollTop;
	              this.scrollTop = 0;
	              window.scroll(0, scrollTo);
	         } else {
	              isScrollFix = false;
	         }
	})

	function elmOffset(obj) {
		var  offset = 0;
		if (obj.offsetParent) {
			do {
				offset += obj.offsetTop
			} while( (obj = obj.offsetParent) != null);
		}
		return offset;
	}
});
	$(function() {

		//-------- hover select example
		$('#sort2 li a.selected').live('mouseover', function() {
			$('#sort2 li a.option:not(.selected)').show();			
			return false;
		}); 
		
		//check for selecting a new option
		$('#sort2 li a.option').live('click', function() {
			//change over the selected class
			$('#sort2 li a').removeClass('selected');
			//apply this to the new selection
			$(this).addClass('selected');
			//slide up the selected option
			$('#sort2 li a.option:not(.selected)').hide();			
			return false;
		});
		
		//-------- advanced example
		$('#sort3 li a.selected').live('click', function() {
			//check if the options are visible
			if( $('#sort3 li a.option:visible').length > 1) {
				//hide the options if currently displaying
				$('#sort3 li a.option:not(.selected)').hide();			
			} else {
				//show the options if hidden
				$('#sort3 li a.option:not(.selected)').show();			
			}
			return false;
		}); 
		
		//check for selecting a new option
		$('#sort3 li a.option:not(.selected)').live('click', function() {
			//change over the selected class
			$('#sort3 li a').removeClass('selected');
			//apply this to the new selection
			$(this).addClass('selected');
			//slide up the selected option
			$('#sort3 li a.option:not(.selected)').hide();			
			return false;
		});

		//-------- populate form examples
		$('#sort4 li a.selected').live('click', function() {
			//check if the options are visible
			if( $('#sort4 li a.option:visible').length > 1) {
				//hide the options if currently displaying
				$('#sort4 li a.option:not(.selected)').hide();			
			} else {
				//show the options if hidden
				$('#sort4 li a.option:not(.selected)').show();			
			}
			return false;
		}); 
		
		//check for selecting a new option
		$('#sort4 li a.option:not(.selected)').live('click', function() {
			//change over the selected class
			$('#sort4 li a').removeClass('selected');
			//apply this to the new selection
			$(this).addClass('selected');
			//update the select option
			$("input[name='option']").val( $(this).attr('title') );
			//slide up the selected option
			$('#sort4 li a.option:not(.selected)').hide();			
			return false;
		});		
		
	});

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $(":checkbox").change(function() {
        $(this).closest('li').find(':checkbox').attr('checked', this.checked);
        if (this.checked === false) {
            $(this).parents().children(':checkbox').attr('checked', this.checked);
        }
    });

});




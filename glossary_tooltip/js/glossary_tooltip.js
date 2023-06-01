(function ($, Drupal) {
  Drupal.behaviors.glossaryTooltip = {
    attach: function (context) {
      $('.glossary-term', context).once('glossary-tooltip').each(function () {
        var termDescription = $(this).attr('title');
        var termUrl = $(this).data('url');
        $(this).removeAttr('title');

        $(this).tooltip({
          content: function () {
            var description = termDescription;
            if (description.length > 100) {
              description = description.substring(0, 100) + '... <a href="' + termUrl + '">Read more</a>';
            }
            return description;
          },
        });
      });
    }
  };
})(jQuery, Drupal);
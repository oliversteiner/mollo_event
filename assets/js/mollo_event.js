(function($, Drupal, drupalSettings) {
  Drupal.behaviors.molloArtist = {
    attach(context, settings) {
      console.log("Mollo Artist");

        $('#mollo-event', context)
          .once('mollo-event')
          .each(() => {});

    },
  };
})(jQuery, Drupal, drupalSettings);

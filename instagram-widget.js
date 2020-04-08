(function($){
  $(document).ready(function(){
    //console.log(igfeed);
    const igFeed = new Vue({
      el: '#ig-feed',
      data: {
        feedImg: []
      },
      mounted: function(){
        this.loadSlides();
        this.initSwiper();
      },
      methods: {
        initSwiper: function(){
          const feedSwiper = new Swiper('.swiper-feed', {
            slidesPerView: 4,
            spaceBetween: 80,
            slidesPerGroup: 3,
            virtual: {
              cache: true,
              slides: this.feedImg,
              renderExternal: function(feedImg){
                this.feedImg = feedImg;
              }
            },
            autoplay: {
              delay: 5000
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
          });
        },
        loadSlides: function()
        {
          axios.get(igfeed.profile_url).then( (response) => {
            response.data.graphql.user.edge_owner_to_timeline_media.edges.forEach( (item ,i) => {
              f = {
                url: item.node.display_url
              };
              this.feedImg.push(f);
            });
          });
        }
      }
    });
  });
}(jQuery));

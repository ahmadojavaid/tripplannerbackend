<div class="page-section">
  <div class="section-head">
    <h2 class="section-title mb-4">Instagram photos</h2>
    <p>
      Make your own trip to South America vvvvvvvvvvvvvvvvvvvvvvvv v
      Make your own trip to South America vvvvvvvvvvvvvv
    </p>
  </div>
  <div class="section-content">
    <div class="section-content">
      <div class="images-grid">
        <div class="row display-insta-images">

        </div>
      </div>
    </div>
  </div>
  <div class="section-footer border-b">
    <button class=" btn btn-primary d-none view-more-images" href="javascript:void(0)">View more</button>
  </div>
</div>

@push('page-script')
<script src="{{asset('user/js/instagram-feed.js')}}"></script>
<script>
  $(document).ready(function(){
    let images = [
      ];

    $(document).on('click' , '.view-more-images'  ,function(params) {
      images = [];
    handleInstaImages(12);
    $(this).addClass('d-none');

    });
    handleInstaImages(6);

    function handleInstaImages(count){
      new InstagramFeed({
        'tag': "{{$place->instagram_tag}}",
        callback:(response)=>{
          response.edge_hashtag_to_media.edges.every(edge => {
            images.push({
              'thumbnail' :edge.node.thumbnail_resources[4].src,
              'display_image' :edge.node.display_url
            });
            if(images.length === count) return false;
            return true;
          });

          displayImages(images);
          if(response.edge_hashtag_to_media.count > 6 && count === 6)
            $('.view-more-images').removeClass('d-none');
        },
        on_error : function(error_description, error_code){

            $('.display-insta-images').html('<p class="col">No image found</p>');
        }
      });
    }


    function displayImages(images){
      let imagesContent = '';
      images.forEach(({thumbnail , display_image}) => {
        imagesContent += `<a href=${display_image} data-toggle="lightbox" data-gallery="gallery"
            class="col-md-4">
            <img src=${thumbnail} class="img-fluid rounded">
          </a>`;
      });
      $('.display-insta-images').html(imagesContent);
    }


  });

</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
  integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js">
  @endpush

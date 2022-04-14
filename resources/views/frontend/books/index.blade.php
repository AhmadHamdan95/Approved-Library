@extends('frontend.layout.master')

@section('title','Books')

@section('style')
    <style>
       .shop-layout__content{
          width: 100%;
       }
    </style>
@endsection

@section('content')
<!-- site__body -->
<div class="site__body">
    <div class="page-header">
       <div class="page-header__container container">
          <div class="page-header__breadcrumb">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item">
                      <a href="index.html">Home</a> 
                      <svg class="breadcrumb-arrow" width="6px" height="9px">
                         <use xlink:href="{{asset('library/images/sprite.svg#arrow-rounded-right-6x9')}}"></use>
                      </svg>
                   </li>
                   <li class="breadcrumb-item">
                      <a href="#">Breadcrumb</a> 
                      <svg class="breadcrumb-arrow" width="6px" height="9px">
                         <use xlink:href="{{asset('library/images/sprite.svg#arrow-rounded-right-6x9')}}"></use>
                      </svg>
                   </li>
                   <li class="breadcrumb-item active" aria-current="page">Screwdrivers</li>
                </ol>
             </nav>
          </div>
          <div class="page-header__title">
             <h1>Screwdrivers</h1>
          </div>
       </div>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h5><i class="icon fas fa-ban"></i> Alert!</h5>
         <ul>
         @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
         @endforeach
         </ul>
      </div>
   @endif
    <div class="container">
       <div class="shop-layout shop-layout--sidebar--start">
          <div class="shop-layout__content">
             <div class="block">
                <div class="products-view">
                   <div class="products-view__options">
                      <div class="view-options">
                         <div class="view-options__layout">
                            <div class="layout-switcher">
                               <div class="layout-switcher__list">
                                  <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid" type="button" class="layout-switcher__button layout-switcher__button--active">
                                     <svg width="16px" height="16px">
                                        <use xlink:href="{{asset('library/images/sprite.svg#layout-grid-16x16')}}"></use>
                                     </svg>
                                  </button>
                                  <button data-layout="grid-3-sidebar" data-with-features="true" title="Grid With Features" type="button" class="layout-switcher__button">
                                     <svg width="16px" height="16px">
                                        <use xlink:href="{{asset('library/images/sprite.svg#layout-grid-with-details-16x16')}}"></use>
                                     </svg>
                                  </button>
                                  <button data-layout="list" data-with-features="false" title="List" type="button" class="layout-switcher__button">
                                     <svg width="16px" height="16px">
                                        <use xlink:href="{{asset('library/images/sprite.svg#layout-list-16x16')}}"></use>
                                     </svg>
                                  </button>
                               </div>
                            </div>
                         </div>
                         <div class="view-options__legend">Showing 6 of 98 products</div>
                         <div class="view-options__divider"></div>
                         <div class="view-options__control">
                            <label for="">Sort By</label>
                            <div>
                               <select class="form-control form-control-sm" name="" id="">
                                  <option value="">Default</option>
                                  <option value="">Name (A-Z)</option>
                               </select>
                            </div>
                         </div>
                         <div class="view-options__control">
                            <label for="">Show</label>
                            <div>
                               <select class="form-control form-control-sm" name="" id="">
                                  <option value="">12</option>
                                  <option value="">24</option>
                               </select>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="products-view__list products-list" data-layout="grid-3-sidebar" data-with-features="false">
                      <div class="products-list__body">
                          @foreach ($books as $book)
                          <div class="products-list__item">
                            <div class="product-card">
                               <button class="product-card__quickview" type="button">
                                  <svg width="16px" height="16px">
                                     <use xlink:href="{{asset('library/images/sprite.svg#quickview-16')}}"></use>
                                  </svg>
                                  <span class="fake-svg-icon"></span>
                               </button>
                               <div class="product-card__badges-list {{$book->status ? '' : 'd-none'}}">
                                  <div class="product-card__badge product-card__badge--{{$book->status}}">{{$book->status}}</div>
                               </div>
                               <div class="product-card__image">
                                   <a href="{{route('bookdetails.index', $book->id)}}">
                                       <img src="{{url(Storage::url($book->image))}}" alt="">
                                    </a>
                                </div>
                               <div class="product-card__info">
                                  <div class="product-card__name"><a href="{{route('bookdetails.index', $book->id)}}">{{$book->name}}</a></div>
                                  <div class="product-card__rating">
                                     <div class="rating">
                                        <div class="rating__body">
                                           <svg class="rating__star rating__star--active" width="13px" height="12px">
                                              <g class="rating__fill">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal')}}"></use>
                                              </g>
                                              <g class="rating__stroke">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal-stroke')}}"></use>
                                              </g>
                                           </svg>
                                           <div class="rating__star rating__star--only-edge rating__star--active">
                                              <div class="rating__fill">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                              <div class="rating__stroke">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                           </div>
                                           <svg class="rating__star rating__star--active" width="13px" height="12px">
                                              <g class="rating__fill">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal')}}"></use>
                                              </g>
                                              <g class="rating__stroke">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal-stroke')}}"></use>
                                              </g>
                                           </svg>
                                           <div class="rating__star rating__star--only-edge rating__star--active">
                                              <div class="rating__fill">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                              <div class="rating__stroke">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                           </div>
                                           <svg class="rating__star rating__star--active" width="13px" height="12px">
                                              <g class="rating__fill">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal')}}"></use>
                                              </g>
                                              <g class="rating__stroke">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal-stroke')}}"></use>
                                              </g>
                                           </svg>
                                           <div class="rating__star rating__star--only-edge rating__star--active">
                                              <div class="rating__fill">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                              <div class="rating__stroke">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                           </div>
                                           <svg class="rating__star rating__star--active" width="13px" height="12px">
                                              <g class="rating__fill">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal')}}"></use>
                                              </g>
                                              <g class="rating__stroke">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal-stroke')}}"></use>
                                              </g>
                                           </svg>
                                           <div class="rating__star rating__star--only-edge rating__star--active">
                                              <div class="rating__fill">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                              <div class="rating__stroke">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                           </div>
                                           <svg class="rating__star" width="13px" height="12px">
                                              <g class="rating__fill">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal')}}"></use>
                                              </g>
                                              <g class="rating__stroke">
                                                 <use xlink:href="{{asset('library/images/sprite.svg#star-normal-stroke')}}"></use>
                                              </g>
                                           </svg>
                                           <div class="rating__star rating__star--only-edge">
                                              <div class="rating__fill">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                              <div class="rating__stroke">
                                                 <div class="fake-svg-icon"></div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="product-card__rating-legend">9 Reviews</div>
                                  </div>
                                  <span class="product-card__features-list">{{$book->description}}</span>
                               </div>
                               <div class="product-card__actions">
                                  <div class="product-card__availability" style="display: block">Availability: <span class="text-{{$book->quantity > 0 ? 'success' : 'danger'}}">{{$book->quantity > 0 ? 'In Stock' : 'Out of stock'}}</span></div>
                                  <div class="product-card__prices">${{$book->price}}</div>
                                  <div class="product-card__buttons">
                                     <a href="{{route('bookdetails.index', $book->id)}}" class="btn btn-primary product-card__addtocart">Add To Cart</a>
                                     {{-- <form action="{{route('wishlist.store')}}" method="POST">
                                       @csrf
                                       <input type="text" name="bookId" value="{{$book->id}}" hidden>
                                       <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist" type="submit">
                                          <svg width="16px" height="16px">
                                             <use xlink:href="{{asset('library/images/sprite.svg#wishlist-16')}}"></use>
                                          </svg>
                                          <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
                                       </button>
                                    </form> --}}
                                    <a class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist" href="#" data-book-id="{{$book->id}}">
                                       <svg width="16px" height="16px">
                                          <use xlink:href="{{asset('library/images/sprite.svg#wishlist-16')}}"></use>
                                       </svg>
                                       <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
                                    </a>
                                     <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare" type="button">
                                        <svg width="16px" height="16px">
                                           <use xlink:href="{{asset('library/images/sprite.svg#compare-16')}}"></use>
                                        </svg>
                                        <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
                                     </button>
                                  </div>
                               </div>
                            </div>
                         </div>
                          @endforeach
                      </div>
                   </div>
                   <div class="products-view__pagination">
                      <ul class="pagination justify-content-center">
                         <li class="page-item disabled">
                            <a class="page-link page-link--with-arrow" href="#" aria-label="Previous">
                               <svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px">
                                  <use xlink:href="{{asset('library/images/sprite.svg#arrow-rounded-left-8x13')}}"></use>
                               </svg>
                            </a>
                         </li>
                         <li class="page-item"><a class="page-link" href="#">1</a></li>
                         <li class="page-item active"><a class="page-link" href="#">2 <span class="sr-only">(current)</span></a></li>
                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                         <li class="page-item">
                            <a class="page-link page-link--with-arrow" href="#" aria-label="Next">
                               <svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px">
                                  <use xlink:href="{{asset('library/images/sprite.svg#arrow-rounded-right-8x13')}}"></use>
                               </svg>
                            </a>
                         </li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<!-- site__body / end -->
@endsection

@section('script')

<script>
   $(document).on('click', '.product-card__wishlist', function(e){
      e.preventDefault();
      // @guest
      //    $('.className').css('display', 'block');
      // @endguest

      $.ajax({
         type:'post',
         url:"{{route('wishlist.store')}}",
         data: {
            '_token': '{{ csrf_token() }}',
            'bookId': $(this).attr('data-book-id'),
         },
         success: function(data){
            if(data.wishlist){
               $(this).css('color', 'red');
            }else{
               $(this).css('color', '#999');
            }
         }
      });
   });
</script>

@endsection
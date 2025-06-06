<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="caption header-text">
                    <h6>Welcome to ViireakRothShop</h6>
                    <h2>Best Phone Shop</h2>
                    <p>ViireakRothShop is a best phone shop. You can find the best phone here. or search for your
                        favorite phone.come and buy your favorite phone.
                    </p>
                    <div class="search-input">
                        <form id="search" action="{{ route('item.search') }}" method="GET">
                            <input type="text" placeholder="Search for products..." id="searchText"
                                name="searchKeyword" value="{{ request('searchKeyword') }}" required />
                            <button type="submit">Search Now</button>
                        </form>
                    </div>
                </div>
            </div>








            @php
                $productWithBiggestDiscount = $products->sortByDesc('discount')->first();
            @endphp

            @if ($productWithBiggestDiscount)
                <div class="col-lg-4 offset-lg-2">
                    <div class="right-image">
                        <img src="{{ asset('products/' . $productWithBiggestDiscount->image) }}"
                            alt="{{ $productWithBiggestDiscount->name }}">
                        <span
                            class="price">${{ number_format($productWithBiggestDiscount->price - ($productWithBiggestDiscount->price * $productWithBiggestDiscount->discount) / 100, 2) }}</span>
                        <span class="offer">{{ number_format($productWithBiggestDiscount->discount, 0) }}%</span>

                        @if ($productWithBiggestDiscount->quantity_sold > 100)
                            <span class="badge badge-success">Best Seller</span>
                        @endif
                    </div>
                </div>
            @endif



        </div>
    </div>
</div>

<div class="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="item">
                        <div class="image">
                            <img src="pic/intagram.png" alt="" style="max-width: 77px;">
                        </div>
                        <h4>Intagram</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="item">
                        <div class="image">
                            <img src="pic/facebook.png" alt="" style="max-width: 600px;">
                        </div>
                        <h4>Facbook</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="item">
                        <div class="image">
                            <img src="pic/telegram.png" alt="" style="max-width: 70px;">
                        </div>
                        <h4>Telegram</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="item">
                        <div class="image">
                            <img src="pic/tiktok.png" alt="" style="max-width: 600px;z-index: 1;">
                        </div>
                        <h4>Tiktok</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

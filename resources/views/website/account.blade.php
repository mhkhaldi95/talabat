@extends('website.layout.master')
@section('content')
    <!-- user -->
    <div class="user-data h-100vw">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-5">
                    <div class="user-body  h-100 ">
                        <div class="row row-cols-1 ">
                            <div class="col">
                                <div class="user-link user-item active-user my-3 p-2 pointer" id="myDataLink"   onclick="toggleProfile()">
                                    <i class="fa-solid fa-circle-user fa-xl"></i>
                                    <span class="mx-2">my data</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="user-link orders-item  my-3 p-2 pointer"   id="myOrdersLink" onclick="toggleMyOrders()">
                                    <i class="fa-solid fa-calendar-days fa-xl"></i>
                                    <span class="mx-2">my orders</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="user-link cash-item  my-3 p-2 pointer" id="cashBackLink" onclick="toggleCashBack()">
                                    <i class="fa-solid fa-cash-register fa-xl"></i>
                                    <span class="mx-2">cash back</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="out-item  my-3 p-2 text-danger pointer" onclick="goToUrl('{{route('break.logout')}}')">
                                    <i class="fa-solid fa-right-from-bracket fa-xl"></i>
                                    <span class="mx-2">sign out</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="links-content col-md-8 orders data-form mt-5 " id="cashBack">

                    <div class="discount bg-gray text-center p-3">
                        <div data-i18n="orderNumber">order #3232</div>
                    </div>
                    <div class="row  row-cols-1 gy-2 mt-3">
                        <div class="col">
                            <div class="product-item">
                                <div class="card">
                                    <img src="{{asset('')}}assets/website/images/product.png" class="card-img-top" alt="product">
                                    <div class="card-body text-center">
                                        <h5 class="card-title" data-i18n="productName">donats</h5>
                                        <p class="card-text" data-i18n="productText">Some quick example text to build on
                                            the card title and
                                            make up the bulk of the card's content.</p>
                                    </div>
                                    <p class="text-center"> order data</p>
                                    <div class="delivery-data mx-3">
                                        <p>delivery data</p>
                                        <div class="reciver-branch bg-gray">
                                            <p class="pt-2 mx-2 ">reciver branch</p>
                                            <div class="cart-branch-user p-2 my-3">

                                                <div class="cart-branch-content d-flex align-items-center ">
                                                    <div class=""> <i
                                                            class="fa-solid fa-bag-shopping color-main fa-xl"></i>
                                                    </div>
                                                    <div class="mx-4 " href="#" role="button" data-i18n="branchName">
                                                        suadi - reyad
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 ">
                                            <div class="col-md-2">
                                                <img src="{{asset('')}}assets/website/images/product.png"
                                                     class="img-fluid rounded-start  w-100" alt="">
                                            </div>
                                            <div class="col-md-10">

                                                <div class="d-flex justify-content-between align-items-center py-2">
                                                    <div data-i18n="productName">product name</div>
                                                    <div data-i18n="productPrice">50 SAR</div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mb-3 ">
                                            <div class="col-md-2">
                                                <img src="{{asset('')}}assets/website/images/product.png"
                                                     class="img-fluid rounded-start  w-100" alt="">
                                            </div>
                                            <div class="col-md-10">

                                                <div class="d-flex justify-content-between align-items-center py-2">
                                                    <div data-i18n="productName">product name</div>
                                                    <div data-i18n="productPrice">50 SAR</div>
                                                </div>

                                            </div>
                                        </div>
                                        <div
                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                            <div data-i18n="discountText">discount percentage</div>
                                            <div data-i18n="percentage">20%</div>
                                        </div>
                                        <div
                                            class="total d-flex justify-content-between bg-gray align-items-center p-2 my-3">
                                            <div data-i18n="totalText">Total</div>
                                            <div data-i18n="totalAmount">20%</div>
                                        </div>
                                        <div class="reciver-branch bg-gray">
                                            <p class="pt-2 mx-2 ">payment method</p>
                                            <div class="cart-branch-user p-2 my-3">

                                                <div class="input-group align-items-center">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                                    </div>
                                                    <span class="mx-3">Online payment</span>

                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-center btn btn-outline-danger my-3 w-100 "> Being processed <i
                                                class="fa-solid fa-list-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="links-content col-md-8 orders data-form mt-5 d-none " id="myOrders" >
                    <div class="row row-cols-md-2 ">

                        <div class="col">
                            <button class="btn color-main w-100 p-3 " onclick="newOrders()" id="NewOrdersBtn">
                                <i class="fa-solid fa-table-list"></i>
                                <span class="mx-2">New Order</span>
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn color-main w-100 active-order p-3" onclick="ordersHistory()" id="OrderHistoryBtn">
                                <i class="fa-solid fa-table-list"></i>
                                <span class="mx-2">Order history</span>
                            </button>
                        </div>
                    </div>
                    <div class="row row-cols-md-2 mt-3 " id="NewOrders">
                        <div class="col">
                            <div class="product-item">
                                <div class="card">
                                    <div class="item-img position-relative">
                                        <img src="{{asset('')}}assets/website/images/product.png" class="card-img-top" alt="product">
                                        <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                2023-2-2</span>
                                        </div>
                                    </div>

                                    <div class="card-body text-center">
                                        <div
                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                            <div data-i18n="discountText">discount percentage</div>
                                            <div data-i18n="percentage">20%</div>
                                        </div>
                                        <div
                                            class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
                                            <div data-i18n="totalText">Total</div>
                                            <div data-i18n="totalAmount">20%</div>
                                        </div>
                                        <a href="#" class="text-dark  text-decoration-underline text-center"
                                           data-i18n="viewDetails">view details</a>

                                        <button class="btn btn-product w-100 mt-3">
                                            <span class="mx-1" data-i18n="recieveFromBranch">recieve from branch</span>
                                            <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="product-item">
                                <div class="card">
                                    <div class="item-img position-relative">
                                        <img src="{{asset('')}}assets/website/images/product.png" class="card-img-top" alt="product">
                                        <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                2023-2-2</span>
                                        </div>
                                    </div>

                                    <div class="card-body text-center">
                                        <div
                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                            <div data-i18n="discountText">discount percentage</div>
                                            <div data-i18n="percentage">20%</div>
                                        </div>
                                        <div
                                            class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
                                            <div data-i18n="totalText">Total</div>
                                            <div data-i18n="totalAmount">20%</div>
                                        </div>
                                        <a href="#" class="text-dark  text-decoration-underline text-center"
                                           data-i18n="viewDetails">view details</a>

                                        <button class="btn btn-product w-100 mt-3">
                                            <span class="mx-1" data-i18n="recieveFromBranch">recieve from branch</span>
                                            <img src="{{asset('')}}assets/website/images/sal-i.png" alt="" class="w-20px">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row row-cols-md-2 mt-3 d-none" id="OrderHistory">
                        <div class="col">
                            <div class="product-item">
                                <div class="card">
                                    <div class="item-img position-relative">
                                        <img src="{{asset('')}}assets/website/images/product.png" class="card-img-top" alt="product">
                                        <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                2023-2-2</span>
                                        </div>
                                    </div>


                                    <div class="card-body text-center">
                                        <div
                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                            <div data-i18n="discountText">discount percentage</div>
                                            <div data-i18n="percentage">20%</div>
                                        </div>
                                        <div
                                            class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
                                            <div data-i18n="totalText">Total</div>
                                            <div data-i18n="totalAmount">20%</div>
                                        </div>
                                        <a href="#" class="text-dark  text-decoration-underline text-center"
                                           data-i18n="viewDetails">view details</a>

                                        <button class="btn btn-outline-success w-100 mt-3">
                                            <span class="mx-1" >recieved</span>
                                            <i class="fa-solid fa-calendar-check"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="product-item">
                                <div class="card">
                                    <div class="item-img position-relative">
                                        <img src="{{asset('')}}assets/website/images/product.png" class="card-img-top" alt="product">
                                        <div class="card-img-overlay">
                                            <span
                                                class="card-title shadow-sm bg-body p-2 color-main w-25 left rounded text-center">
                                                2023-2-2</span>
                                        </div>
                                    </div>


                                    <div class="card-body text-center">
                                        <div
                                            class="discount d-flex justify-content-between bg-gray align-items-center p-2">
                                            <div data-i18n="discountText">discount percentage</div>
                                            <div data-i18n="percentage">20%</div>
                                        </div>
                                        <div
                                            class="total d-flex justify-content-between bg-gray align-items-center p-2 mt-3">
                                            <div data-i18n="totalText">Total</div>
                                            <div data-i18n="totalAmount">20%</div>
                                        </div>
                                        <a href="#" class="text-dark  text-decoration-underline text-center"
                                           data-i18n="viewDetails">view details</a>

                                        <button class="btn btn-outline-success w-100 mt-3">
                                            <span class="mx-1" >recieved</span>
                                            <i class="fa-solid fa-calendar-check"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="links-content col-md-8  data-form mt-5 d-none" id="myData">
                    <form method="post" action="{{route('customer.update',auth()->user()->id)}}">
                        @csrf
                        <div class="row g-3 row-cols-md-2 row-cols-1 ">
                            <div class="col">
                                <label for="name" class="form-label">name</label>
                                <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}" aria-label="First name" placeholder="ahmed">
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">phone number</label>
                                <input type="tel" class="form-control" aria-label="phone" name="phone"  value="{{auth()->user()->phone}}" placeholder="012 826 78299">
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" aria-label="email" name="email"  value="{{auth()->user()->email}}" placeholder="test@gmail.com">
                            </div>
                            <div class="col">
                                <label for="gender" class="form-label">gender</label>
                                <select class="form-select  gender" name="gender" aria-label="Default select example" placeholder="male">
                                    <option value="{{\App\Constants\Enum::MALE}}" {{auth()->user()->gender == \App\Constants\Enum::MALE ?'selected':''}} >{{__('lang.male')}}</option>
                                    <option value="{{\App\Constants\Enum::FEMALE}}" {{auth()->user()->gender == \App\Constants\Enum::FEMALE ?'selected':''}} >{{__('lang.female')}}</option>
                                </select>
                            </div>
                            <div class="col mt-4">
                                <button class="btn btn-product w-100">save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--../ user -->
@endsection


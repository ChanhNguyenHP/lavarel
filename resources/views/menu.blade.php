<!DOCTYPE html>
<html lang="vi">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<title>Menu</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: #f5f5f5;
  font-size: 1.6rem;
  line-height: 1.55;
  color: #000;
  overflow: hidden auto; }
 
a {
  text-decoration: none;
  color: inherit; }

button,
select {
  border: none;
  outline: none;
  cursor: pointer;
  -webkit-appearance: none;
  cursor: pointer;
   }

button {
  padding: 0;
  background-color: transparent;
   }

input,
textarea {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
   }

.main-wrapper {
    max-width: 127rem;
    margin: auto;
}

#closeCart{
    cursor: pointer;
}
.cart-header {
    padding-top: 4rem;
    display: flex;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    border-bottom: .1rem solid #eee;
    padding-bottom: 1.5rem;
}

#cartItems {

}
.box-checkout{
    position: absolute;
    width: calc(100% - 3rem);
    bottom: 1.5rem;
}

.cart-header span {
    font-weight: 600;
}

/* MENU */

.header-menu {
    display: flex;
    overflow-x: auto;
    background: #fff;
    position: sticky;
    top: 0;
    z-index: 1000;
    flex-direction: column;
    padding-top: 1.5rem;
    box-shadow: 0 .5rem 1rem 0 rgba(28, 28, 28, .06);
}

.header-title{
    text-align: center;
}
.menu-tabs {
    display: flex;
}

.menu-tabs a {
    padding: 1.2rem;
    color: #666;
    text-decoration: none;
}

.menu-tabs a.active {
    color: #16a34a;
    border-bottom: 2px solid #16a34a;
}

/* SECTION */
.section {
    background: #fff;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.box-checkout p{
    display: flex;
    justify-content: flex-end;
}

.box-checkout p span{
    
}

/* ITEM */
.item {
    display: flex;
    margin-bottom: 1.5rem;
    align-items: center;
    justify-content: space-between;
    border-bottom: .1rem solid #eee;
    padding-bottom: 1.5rem;
}

.item img {
    width: 25%;
    height: 25%;
    border-radius: .8rem;
    margin-right: 1rem;
}

.item-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: .5rem;
}

.price {
    font-weight: bold;
    font-size: 1.4rem;
}

/* CART CONTROL */
.cart-control {
    display: flex;
    align-items: center;
}

.btn-add {
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
    background: #16a34a;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 1.6rem;
}

.quantity-control {
    display: none;
    border: .1rem solid #16a34a;
    border-radius: 2rem;
    padding: .3rem .8rem;
    align-items: center;
}

.quantity-control button {
    border: none;
    background: none;
    color: #16a34a;
}

.cart-control.active .btn-add {
    display: none;
}

.cart-control.active .quantity-control {
    display: flex;
}

/* CART BAR */
.cart {
    position: fixed;
    bottom: 1rem;
    left: 1rem;
    right: 1rem;
    background: #16a34a;
    color: #fff;
    text-align: center;
    padding: 1.2rem 0;
    border-radius: 1rem;
    display: none;
    max-width: 100%;
    margin: 0 auto;
    cursor: pointer;
}

/* MODAL */
.cart-modal {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    display: none;
    z-index: 99999;
}

.cart-modal.active {
    display: block;
}

.cart-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    max-width: 100%;
    margin: auto;
    background: #fff;
    border-radius: 0 0 0;
    padding: 1.5rem;
    max-height: 100%;
    height: 100%;
    overflow-y: auto;
}

.checkout-btn {
    width: 100%;
    background: #16a34a;
    color: #fff;
    padding: 1.2rem;
    border: none;
    border-radius: .8rem;
}

.item-content p{
    margin: 0;
    font-weight: 400;
    font-size: 1.6rem;
    color: #9a9a9a;
}

.quantity-control .qty{
    font-size: 1.6rem;
}

.title-cn {
    font-size: 1.8rem;
    margin-bottom: 5px;
    font-weight: 600;
}

.cn-title {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.2rem;
}

.cn-title .item-cn{
    font-size: 1.6rem;
}

.section h3{
    font-size: 1.7rem;
}

#toast-container {
    position: fixed;
    top: 2rem;
    right: 2rem;
    z-index: 999999;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.toast {
    min-width: 25rem;
    max-width: 32rem;
    padding: 1.2rem 1.6rem;
    border-radius: 1rem;
    color: #fff;
    font-size: 1.4rem;
    box-shadow: 0 .5rem 1.5rem rgba(0,0,0,0.2);
    opacity: 0;
    transform: translateX(100%);
    animation: slideIn 0.3s forwards;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.toast.success { background: #16a34a; }
.toast.error { background: #dc2626; }
.toast.warning { background: #f59e0b; }

.toast .close {
    margin-left: 1rem;
    cursor: pointer;
    font-weight: bold;
}

@keyframes slideIn {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideOut {
    to {
        opacity: 0;
        transform: translateX(100%);
    }
}

</style>
</head>

<body>

<div class="main-wrapper">

<div class="header-menu">
    <div class="header-title"> 
        <div class="title-cn">Phá lấu bò Thăng Phát</div>
        <div class="cn-title">
            <div class="item-cn">cn1: 19/11 Thạch Lam, P. Hiệp Tân, Tân Phú, TP. HCM</div>
            <div class="item-cn">cn2: Số 162 Nguyễn Sơn, Tân Phú, TP. HCM</div>
        </div> 
    </div>
    <div class="menu-tabs">
        @foreach($categories as $category)
            <a href="#cat-{{ $category->id }}" class="tab {{ $loop->first ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

@foreach($categories as $category)
<div id="cat-{{ $category->id }}" class="section">
    <h3>{{ $category->name }}</h3>

    @foreach($category->products as $product)
    <div class="item">

        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/80' }}">

        <div class="item-content">
            <div>{{ $product->name }}</div>
            <p>{{ $product->description }}</p>
            <div class="price">{{ number_format($product->price) }}đ</div>
        </div>

        <div class="cart-control"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-price="{{ $product->price }}">

            <button class="btn-add">+</button>

            <div class="quantity-control">
                <button class="btn-minus">-</button>
                <span class="qty">1</span>
                <button class="btn-plus">+</button>
            </div>

        </div>

    </div>
    @endforeach

</div>
@endforeach

</div>

<div class="cart" id="cartBar">
    Xem giỏ hàng • <span id="cartTotal">0</span>đ
</div>

<div class="cart-modal" id="cartModal">
    <div class="cart-content">
        <div class="cart-header">
            <span>Giỏ đồ ăn</span>
            <div id="closeCart">✕</div>
        </div>
        
        <div id="cartItems"></div>
        <div class="box-checkout">
            <p>Tổng: <span id="cartSum">0</span>đ</p>
            <button class="checkout-btn">Đặt hàng</button>
        </div>
    </div>
</div>

<script>
let cart = {};

const cartBar = document.getElementById('cartBar');
const cartTotal = document.getElementById('cartTotal');
const cartItems = document.getElementById('cartItems');
const cartSum = document.getElementById('cartSum');
const cartModal = document.getElementById('cartModal');

document.querySelectorAll('.cart-control').forEach(control => {

    const btnAdd = control.querySelector('.btn-add');
    const btnPlus = control.querySelector('.btn-plus');
    const btnMinus = control.querySelector('.btn-minus');
    const qtyText = control.querySelector('.qty');

    const id = control.dataset.id;
    const name = control.dataset.name;
    const price = parseInt(control.dataset.price);

    btnAdd.addEventListener('click', () => {
        control.classList.add('active');
        cart[id] = {id, name, price, qty:1};
        qtyText.innerText = 1;
        updateCart();
    });

    btnPlus.addEventListener('click', () => {
        if (!cart[id]) return;
        cart[id].qty++;
        qtyText.innerText = cart[id].qty;
        updateCart();
    });

    btnMinus.addEventListener('click', () => {
        if (!cart[id]) return;

        cart[id].qty--;

        if (cart[id].qty <= 0) {
            delete cart[id];
            control.classList.remove('active');
            qtyText.innerText = 1;
        } else {
            qtyText.innerText = cart[id].qty;
        }

        updateCart();
    });

});

function updateCart() {
    let total = 0;
    cartItems.innerHTML = '';

    Object.values(cart).forEach(item => {
        total += item.price * item.qty;

        cartItems.innerHTML += `
            <div class="item">
                <div>${item.qty}x ${item.name}</div>
                <div>${(item.price * item.qty).toLocaleString()}đ</div>
            </div>
        `;
    });

    if (Object.keys(cart).length > 0) {
        cartBar.style.display = 'block';
    } else {
        cartBar.style.display = 'none';
    }

    cartTotal.innerText = total.toLocaleString();
    cartSum.innerText = total.toLocaleString();
}

cartBar.onclick = () => cartModal.classList.add('active');

cartModal.onclick = (e) => {
    if (e.target === cartModal) {
        cartModal.classList.remove('active');
    }
};

const closeCart = document.getElementById('closeCart');
closeCart.onclick = (e) => {
    cartModal.classList.remove('active');
};

const sections = document.querySelectorAll('.section');
const tabs = document.querySelectorAll('.tab');

window.addEventListener('scroll', () => {
    let current = '';

    sections.forEach(section => {
        if (window.scrollY >= section.offsetTop - 120) {
            current = section.id;
        }
    });

    tabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.getAttribute('href') === '#' + current) {
            tab.classList.add('active');
        }
    });
});

document.querySelector('.checkout-btn').addEventListener('click', () => {

    if (Object.keys(cart).length === 0) {
        showToast('Giỏ hàng trống', 'warning');
        return;
    }

    const products = Object.values(cart).map(item => ({
        product_id: item.id,
        quantity: item.qty
    }));

    fetch("{{ route('order.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            products: products
        })
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('Server error');
        }
        return res.json();
    })
    .then(data => {
        if (data.status) {

            showToast(`Đặt hàng thành công - ${data.order_code}`, 'success');

            cart = {};
            updateCart();
            cartModal.classList.remove('active');

            document.querySelectorAll('.cart-control').forEach(control => {
                control.classList.remove('active');
                control.querySelector('.qty').innerText = 1;
            });

        } else {
            showToast(data.message || 'Có lỗi xảy ra', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Lỗi server', 'error');
    });

});

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    toast.innerHTML = `
        <span>${message}</span>
        <span class="close">&times;</span>
    `;

    container.appendChild(toast);

    // Auto remove sau 3s
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s forwards';
        setTimeout(() => toast.remove(), 300);
    }, 3000);

    // Click để tắt
    toast.querySelector('.close').onclick = () => {
        toast.style.animation = 'slideOut 0.3s forwards';
        setTimeout(() => toast.remove(), 300);
    };
}
</script>
<div id="toast-container"></div>
</body>
</html>
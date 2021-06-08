
//Добавить в корзину
let buttonsAddToCart = document.querySelectorAll('.catalog_addToCart');
buttonsAddToCart.forEach((elem)=>{
    elem.addEventListener('click', ()=>{
        let id = elem.getAttribute('data-id');
        let user_id = document.querySelector('.header_greatness')

        if(user_id){user_id = user_id.getAttribute('data-user_id');}
        (
            async () => {
                const response = await fetch('/?async_request', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({
                        action: 'addToCart',
                        item_id: id,
                        user_id: user_id
                    })
                });
                const answer = await response.json();
                document.getElementById('countCart').innerText = answer.count;
            }
        )();
    })
});

//Удалить или добавить в корзине
function sum_price(){
    let allPricesCart = document.querySelectorAll('.full_price_span_cart');
    let sum = 0;
    allPricesCart.forEach((elem)=>{
        sum = sum + +elem.innerText;
    })
    document.getElementById('fullprice_cart').innerText = sum;
    return;
}

if(document.getElementById('fullprice_cart')){sum_price()}


let buttonsPlusInCart = document.querySelectorAll('.cart_PlusMinus');
buttonsPlusInCart.forEach((elem)=>{
    elem.addEventListener('click', ()=>{
        let item_id = elem.getAttribute('data-id');
        let count = document.getElementById(item_id).innerText;
        let sub_action = elem.getAttribute('data-action');
        let user_id = document.querySelector('.header_greatness');
        if(user_id){user_id = user_id.getAttribute('data-user_id')}
        (
            async () => {
                const response = await fetch('/?async_request', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({
                        action: 'cart_CountPlusOrMinus',
                        sub_action: sub_action,
                        item_id: item_id,
                        count: count,
                        user_id: user_id
                    })
                }); 
                const answer = await response.json();
                document.getElementById('price_id_' + item_id).innerText = answer.sum_price;
                sum_price();
                document.getElementById('countCart').innerText = answer.count;
                if(answer.count_item == 0){
                    document.getElementById('cart_item_' + item_id).remove();
                } else {
                    document.getElementById(item_id).innerText = answer.count_item
                }
            }
        )();
    })
});


//Лайки в каталоге
let buttonsLikesCatalog = document.querySelectorAll('.catalog_like_button');
buttonsLikesCatalog.forEach((elem)=>{
    elem.addEventListener('click', ()=>{
        let id = elem.getAttribute('data-id');
        (
            async () => {
                const response = await fetch('/?async_request', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({
                        action: 'addLike',
                        id: id
                    })
                }); // что отправляем
                const answer = await response.json(); // что получаем
                document.getElementById(id).innerText = answer.likes;
            }
        )();
    })
});

let buttonDetailsOrder = document.querySelectorAll('.cart_getDetailUserOrder');
console.log(buttonDetailsOrder);
    buttonDetailsOrder.forEach((elem) => {
        elem.addEventListener( 'click', ()=>{
            order_id = elem.getAttribute('data-order_id');
        (
            async () => {
                const response = await fetch('/?async_request', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({
                        action: 'getDetails',
                        order_id: order_id
                    })
                });
                const answer = await response.json();

                let order_status = 'Ожидает подтверждения';
                if(answer.order.status == 'approved'){
                    order_status = 'Заказ подтвержден';
                }
                
                templateHTML = `
                <p>Номер заказа: <span>${answer.order.id}</span></p>
                <p>Указанное имя: <span>${answer.order.name}</span></p>
                <p>Указанный номер: <span>${answer.order.phone}</span></p>
                <p>Общая стоимость заказа: <span>${answer.order.total_sum} руб.</span></p>
                <p>Статус: ${order_status}</p>
                <a class="cart_deleteUserOrder" href="/cart/?order_id=${answer.order.id}&del">Удалить заказ</a>
                `;

                answer.orderlist.forEach((orderItem)=>{
                    let addHTML = `
                    <hr>
                    <div class="detaiLitem_userCart">
                        <img src="/imgs/${orderItem.img_filename}" height="50px">
                        <div>
                            <p>Наименование товара: ${orderItem.name}</p>
                            <p>Количество: ${orderItem.counts_item}</p>
                        </div>
                    </div>
                    `;
                    templateHTML = templateHTML + addHTML; 
                })


                
                document.getElementById('cart_order_detail').innerHTML = templateHTML;
            }
        )();
    })
});
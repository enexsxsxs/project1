@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="cart-container">
    <h1 class="cart-title">Ваша корзина</h1>
    @if (empty($cart))
        <p class="cart-empty">Корзина пуста.</p>
    @else
        <div class="cart-table-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; @endphp
                        @php $total += $subtotal; @endphp
                        <tr id="cart-item-{{ $id }}">
                            <td class="product-info">
                                <img src="{{ asset($item['picture']) }}" alt="{{ $item['name'] }}" class="product-image">
                                <span class="product-name">{{ $item['name'] }}</span>
                            </td>
                            <td class="product-price">{{ number_format($item['price'], 0, ',', ' ') }} руб.</td>
                            <td class="product-quantity">
                                <input type="number" min="1" value="{{ $item['quantity'] }}" class="quantity-input" data-id="{{ $id }}" data-original-quantity="{{ $item['quantity'] }}">
                            </td>
                            <td class="product-subtotal">{{ number_format($subtotal, 0, ',', ' ') }} руб.</td>
                            <td class="product-remove">
                                <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="remove-btn">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="total-label"><strong>Итого:</strong></td>
                        <td colspan="2" class="total-amount" id="total-amount">{{ number_format($total, 0, ',', ' ') }} руб.</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Форма оформления заказа -->
        <div class="checkout-container">
            <form action="{{ route('order.place') }}" method="POST">
                @csrf
                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment_method" value="0" checked>
                        Наличные
                    </label>
                    <label>
                        <input type="radio" name="payment_method" value="1">
                        Карта
                    </label>
                </div>
                <button type="submit" class="checkout-btn">Оформить заказ</button>
            </form>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Находим все инпуты с количеством товара
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            const productId = this.getAttribute('data-id');
            const newQuantity = this.value;

            // Отправляем AJAX-запрос для обновления количества товара в корзине
            fetch("{{ route('cart.update') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Обновляем сумму для этого товара
                    const subtotalCell = document.querySelector(`#cart-item-${productId} .product-subtotal`);
                    const totalCell = document.getElementById('total-amount');
                    
                    subtotalCell.textContent = `${data.subtotal} руб.`;
                    totalCell.textContent = `${data.total} руб.`;
                } else {
                    // Если количество товара превышает доступное
                    alert(data.message || 'Ошибка при обновлении количества');
                    // Восстановим исходное значение
                    this.value = this.getAttribute('data-original-quantity');
                }
            })
            .catch(error => console.error('Ошибка обновления количества:', error));
        });
    });
});
</script>

<style>
    body {
        font-family: "Playfair Display", serif;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
    }

    .cart-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .cart-title {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 2rem;
        text-align: center;
    }

    .cart-empty {
        text-align: center;
        font-size: 1.2rem;
        color: #7f8c8d;
    }

    .cart-table-container {
        overflow-x: auto;
    }

    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 1rem;
    }

    .cart-table th {
        background-color: #3498db;
        color: #ffffff;
        font-weight: bold;
        padding: 1rem;
        text-align: left;
    }

    .cart-table td {
        background-color: #ecf0f1;
        padding: 1rem;
        vertical-align: middle;
        transition: all 0.3s ease;
    }

    .product-info {
        display: flex;
        align-items: center;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-right: 1rem;
        background-color: #ffffff;
        padding: 0.5rem;
        border-radius: 4px;
    }

    .product-name {
        font-weight: bold;
    }

    .quantity-form {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 60px;
        padding: 0.5rem;
        border: 1px solid #bdc3c7;
        border-radius: 4px;
        margin-right: 0.5rem;
    }

    .update-btn, .remove-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
    }

    .update-btn {
        background-color: #2980b9;
        color: #ffffff;
    }

    .update-btn:hover {
        background-color: #2980b9;
    }

    .remove-btn {
        background-color: #e74c3c;
        color: #ffffff;
    }

    .remove-btn:hover {
        background-color: #c0392b;
    }

    .total-label {
        text-align: right;
        font-size: 1.2rem;
    }

    .total-amount {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
    }

    .checkout-container {
        margin-top: 2rem;
        text-align: center;
    }

    .payment-method {
        margin-bottom: 1rem;
    }

    .checkout-btn {
        padding: 1rem 2rem;
        background-color: #3498db;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1.2rem;
    }

    .checkout-btn:hover {
        background-color: #2980b9;
    }
</style>
@endsection

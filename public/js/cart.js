
    function addQuantity(element) {
        var input = element.parentNode.previousElementSibling;
        input.stepUp();
        showUpdateButton(input);
    }

    function subtractQuantity(element) {
        var input = element.parentNode.nextElementSibling;
        input.stepDown();
        showUpdateButton(input);
    }

    function showUpdateButton(input) {
        input.parentNode.nextElementSibling.querySelector('input[type="submit"]').style.display = 'inline-block';
        updateTotal();
    }

    function updateTotal() {
        var total = 0;
        document.querySelectorAll('.cart-table tbody tr').forEach(function(row) {
            var quantity = parseInt(row.querySelector('input[name="quality"]').value);
            var price = parseFloat(row.querySelector('td:nth-child(5)').textContent.replace('£', '').replace(/,/g, ''));
            total += quantity * price;
        });
        document.getElementById('total').textContent = '£' + formatCurrency(total);
    }

    document.querySelector('.apply-discount').addEventListener('click', function() {
        var discountCode = document.getElementById('discount-codes').value;
        applyDiscount(discountCode);
    });
    function applyDiscount(discountCode) {
    // Reset biến discount về 0 trước khi tính toán giảm giá cho mã mới
    var discount = 0;
    var newTotal = calculateNewTotal(discountCode);
    document.getElementById('total').textContent = '£' + formatCurrency(newTotal);
    
    // Xóa option đã chọn khỏi dropdown
    var selectedOption = document.querySelector('#discount-codes option[value="' + discountCode + '"]');
    selectedOption.parentNode.removeChild(selectedOption);

    // Tìm mã giảm giá đã được chọn trước đó và áp dụng lớp CSS cho nó
    var previousSelectedOption = document.querySelector('#discount-codes option[selected]');
    if (previousSelectedOption) {
        previousSelectedOption.removeAttribute('selected');
        previousSelectedOption.classList.remove('discount-selected');
    }

    // Chọn option mới và thêm thuộc tính 'selected'
    var selectedOption = document.querySelector('#discount-codes option[value="' + discountCode + '"]');
    selectedOption.setAttribute('selected', true);

    // Đồng thời áp dụng lớp CSS 'discount-selected' cho mã giảm giá đã chọn
    selectedOption.classList.add('discount-selected');
}





    function calculateNewTotal(discountCode) {
        var currentTotal = parseFloat(document.getElementById('total').textContent.replace('£', '').replace(/,/g, ''));
        switch(discountCode) {
            case 'code1':
                discount = 20;
                break;
            case 'code2':
                discount = 50;
                break;
            case 'code3':
                discount = 10;
                break;
            case 'code4':
                discount = 40;
                break;
            case 'code5':
                discount = 30;
                break;
            default:
                discount = 0;
        }
        var newTotal = currentTotal - (currentTotal * (discount / 100));
        return newTotal;
    }

    function formatCurrency(amount) {
        return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }


<?php include_once 'app/views/shareuser/header.php'; ?>
<style>
    .news_section_container {
        margin-top: 50px;
    }

    .row-item-new {
        margin-bottom: 30px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

        .row-item-new:hover {
            transform: scale(1.02);
        }

    .title-news {
        font-size: 28px;
        border-bottom: 2px solid #333;
        padding: 20px 0;
        margin-bottom: 30px;
        text-align: center;
    }

    .img-box {
        max-width: 100%;
        height: 200px;
        overflow: hidden;
        background-color: #f0f0f0;
    }

        .img-box img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

    .content-box {
        padding: 20px;
    }

    h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .description-box {
        color: #555;
    }

    .pagination {
        margin: 20px 0;
        display: flex;
        justify-content: center;
    }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            display: block;
            padding: 8px 12px;
            background-color: #f0f0f0;
            border-radius: 4px;
            color: #333;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

            .pagination a:hover {
                background-color: #ddd;
            }

    .active a {
        background-color: #333;
        color: #fff;
    }

    .btn-save,
    .btn-use-now {
        background-color: #ee4d2d;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 10px;
        right: 10px;
        height: 40px;
        border-radius: 3px;
        font-size: 14px;
        padding: 0.5rem 1rem;
        outline: 0 !important;
    }

    .btn-use-now {
        top: 60px;
    }

    .btn-icon {
        margin-right: 5px;
    }

    .row-item-new {
        position: relative;
    }

    .content-box {
        padding: 20px 20px 20px 0;
    }
</style>

<div class="container news_section_container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-news">Khuyến mãi</h1>
        </div>
    </div>
    <?php if (!empty($vouchers)): ?>
        <?php foreach ($vouchers as $voucher): ?>
            <!-- Bắt đầu vòng lặp foreach -->
            <div class="row row-item-new" id="trow_<?php echo $voucher['id']; ?>">
                <div class="col-md-3">
                    <div class="img-box">
                        <!-- Sử dụng hình ảnh của voucher, thay vì cố định -->
                        <img src="/chieu2/public/img/ADPshop.jpg" alt="" />
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content-box">
                        <h3><a href="#" title="<?php echo $voucher['name']; ?>"><?php echo $voucher['name']; ?></a></h3>
                        <div class="description-box">
                            <?php echo $voucher['description']; ?>
                        </div>
                    </div>
                </div>
                <?php if ($voucher['isSave']): ?>
                    <!-- Nếu đã lưu -->
                    <button class="btn btn-success btn-save" disabled><i class="fa fa-check btn-icon" aria-hidden="true"></i>Đã lưu</button>
                <?php else: ?>
                    <!-- Nếu chưa lưu -->
                    <button class="btn btn-primary btn-save" data-id="<?php echo $voucher['id']; ?>"><i class="fa fa-clone btn-icon" aria-hidden="true"></i>Lưu</button>
                <?php endif; ?>
                <!-- Button mua ngay -->
                <a href="/ShoppingCart/Index" class="btn btn-success btn-use-now" data-id="<?php echo $voucher['id']; ?>"><i class="fa fa-shopping-cart btn-icon" aria-hidden="true"></i>Dùng ngay</a>
            </div>
            <!-- Kết thúc vòng lặp foreach -->
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Nếu không có voucher nào -->
        <p>No vouchers found.</p>
    <?php endif; ?>
</div>



<?php include_once 'app/views/shareuser/footer.php'; ?>

<?php

/**
 * gallery Section - แสดงแพ็คเกจราคาทั้งหมดของคลินิก
 */
?>
<style>
    /* Stats Section */
    .stats {
        background: var(--primary);
        color: white;
        padding: 80px 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        text-align: center;
    }

    .stat-item h3 {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .stat-item p {
        font-size: 1.2rem;
    }
</style>
<section class="stats" id="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <h3 class="counter" data-target="5000">0</h3>
                <p>ลูกค้าที่พึงพอใจ</p>
            </div>
            <div class="stat-item">
                <h3 class="counter" data-target="8">0</h3>
                <p>ปีประสบการณ์</p>
            </div>
            <div class="stat-item">
                <h3 class="counter" data-target="15">0</h3>
                <p>ผู้เชี่ยวชาญ</p>
            </div>
            <div class="stat-item">
                <h3 class="counter" data-target="98">0</h3>
                <p>% ความพึงพอใจ</p>
            </div>
        </div>
    </div>
</section>
<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 3/9/2017
 * Time: 6:12 AM
 */
?>
<nav>
    <ul class="pagination" v-if="pagination.total > pagination.per_page">
        <li v-if="pagination.current_page > 1">
            <a href="javascript:void(0)" aria-label="Previous"
               @click.prevent="changePage(pagination.current_page - 1)">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <li v-for="page in pagesNumber" v-bind:class="[ page == isActive ? 'active' : '']">
            <a href="javascript:void(0)" @click.prevent="changePage(page)">
                @{{ page }}
            </a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <a href="javascript:void(0)" aria-label="Next"
               @click.prevent="changePage(pagination.current_page + 1)">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</nav>

<div class="bq_meta_control bq_product_meta_box">
    <table class="wp-list-table widefat striped">
        <tbody>
            <tr>
                <td><label>Bangla Title</label></td>
                <td>
                    <input type="text" name="_bq_product_meta[_bn_title]" value="<?php if (!empty($meta['_bn_title'])) echo $meta['_bn_title']; ?>" style="width:100%;" />
                </td>


            </tr>
            <tr>
                <td><label>Cover</label></td>
                <td>
                    <input type="text" name="_bq_product_meta[_cover_page]" value="<?php if (!empty($meta['_cover_page'])) echo $meta['_cover_page']; ?>" style="width:100%;" />
                </td>
            </tr>
            <tr>
                <td><label>ISBN</label></td>
                <td>
                    <input type="text" name="_bq_product_meta[_isbn]" value="<?php if (!empty($meta['_isbn'])) echo $meta['_isbn']; ?>" style="width:100%;" />
                </td>
            </tr>
            <tr>
                <td><label>Date of publish</label></td>
                <td>
                    <input type="text" name="_bq_product_meta[_publishDate]" value="<?php if (!empty($meta['_publishDate'])) echo $meta['_publishDate']; ?>" style="width:100%;" placeholder="Year-Month-Day"/>
                </td>
            </tr>
        </tbody>
    </table>
</div>

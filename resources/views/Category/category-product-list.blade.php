@include('header')

<main>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    <div class="categorytable mt-3 container">
        <table class="table table-bordered text-center">
            <tr>
                <th>Product No</th>
                <th>Product Name</th>
                <th>Product Description</th>
            </tr>
            <?php
            // echo "<pre>";
            // print_r($prodlist);
            // die();
            $i = 0;
            foreach ($prodlist as $pl) {
                foreach ($pl['product'] as $p){
            ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $p['prod_name']; ?></td>
                    <td><?php echo $p['prod_desc']; ?></td>
                </tr>
            <?php
                $i++;
                }
            }
            ?>
        </table>
    </div>
</main>
@include('footer')
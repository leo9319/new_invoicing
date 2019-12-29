
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dynamically Add or Remove Table Row Using VueJS</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    
</head>

<body>


	<div id="app">
	    <table>
	    	<thead>
	    		<tr>
		    		<th scope="col text-right">#</th>
		    		<th scope="col text-right">Item No</th>
		    		<th scope="col text-right">Item Name</th>
		    		<th scope="col text-right">Price</th>
		    		<th scope="col text-right">Quantity</th>
		    		<th scope="col text-right">Total</th>
		    	</tr>
	    	</thead>
	    	<tr v-for="(invoice_product, k) in invoice_products" :key="k">
			    <td scope="row" class="trashIconContainer">
			        <i class="far fa-trash-alt" @click="deleteRow(k, invoice_product)">D</i>
			    </td>
			    <td>
			        <input class="form-control" type="text" v-model="invoice_product.product_no" />
			    </td>
			    <td>
			        <input class="form-control" type="text" v-model="invoice_product.product_name" />
			    </td>
			    <td>
			        <input class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.product_price" @change="calculateLineTotal(invoice_product)"
			        />
			    </td>
			    <td>
			        <input class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.product_qty" @change="calculateLineTotal(invoice_product)"
			        />
			    </td>
			    <td>
			        <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.line_total" />
			    </td>
			</tr>
	    </table>

	    <button type='button' class="btn btn-info" @click="deleteRow">
		    <i class="fas fa-plus-circle"></i>
		    Add
		</button>
	</div>

	<script type="text/javascript">
		var app = new Vue({
	        el: "#app",
	        data: {
	            invoice_products: [{
	                product_no: '',
	                product_name: '',
	                product_price: '',
	                product_qty: '',
	                line_total: 0
	            }]
	        },

	        methods:{
		        addNewRow() {
		            this.invoice_products.push({
		                product_no: '',
		                product_name: '',
		                product_price: '',
		                product_qty: '',
		                line_total: 0
		            });
		        },
		        
		        deleteRow(index, invoice_product) {
		            var idx = this.invoice_products.indexOf(invoice_product);
		            console.log(idx, index);
		            if (idx > -1) {
		                this.invoice_products.splice(idx, 1);
		            }
		            this.calculateTotal();
		        },
		    }
	    });
	</script>

</body>

</html>

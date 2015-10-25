     	    <div class="rsidebar span_1_of_left">
				<?php foreach ($rsarray_class_sontree as $v) {
					if (empty($v['good_class_parentid_FK_good_class_id'])) { 
					?>
		        <section  class="sky-form">
					<h4><?php echo $v['good_class_name']; ?></h4>
						<div class="row row1 scroll-pane">
							<!-- <div class="col col-4">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Adidas by Stella McCartney</label>
							</div> -->
							<div class="col col-4">
								<?php foreach ($rsarray_class_sontree as $w) {
									if (!empty($w['good_class_parentid_FK_good_class_id'])) {
										if ($w['good_class_parentid_FK_good_class_id'] == $v['good_class_id']) { 
									?>
								<a href="?classid=<?php echo $w['good_class_id']; ?>"><label class="checkbox"><!-- <input type="checkbox" name="checkbox" <?php if ($w['good_class_id'] == $classid) {echo ' checked=checked';} ?>> --><i></i><?php echo $w['good_class_name']; ?></label></a>
								<?php }//ifII
									}//ifII
									}//foreachII
									?>
							</div>
						</div>
		       </section>
				<?php }//if
				}//foreach
				?>
		</div>
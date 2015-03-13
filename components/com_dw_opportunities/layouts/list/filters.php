<?php 

defined('_JEXEC') or die;

$beneficiaries = $displayData['beneficiaries'];
$causeareas = $displayData['causeareas'];
$resetlink = $displayData['resetlink'];

$app = JFactory::getApplication();
$jinput = $app->input;

$dashboard = ( $jinput->get('dashboard', '', 'string'=='true') ) ? true : null ;

$donorwizUrl = new DonorwizUrl()
?>

<div class="uk-width-1-1 uk-margin-large-bottom" data-uk-sticky="{top:76}" style="background:#fff;">

	<div class="uk-width-1-1 uk-text-right uk-margin-small-top uk-form">
		
		<?php if( $resetlink == true && !$dashboard ):?>
				<a class="uk-button uk-button-mini uk-button-link" href="<?php echo JRoute::_('index.php?option=com_dw_opportunities&view=dwopportunities'); ?>">
					<i class="uk-icon-remove uk-icon-small"></i>
					<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_RESET');?>
				</a>
		<?php endif;?>

		<?php if( $dashboard ):?>
				<a class="uk-button uk-button-mini uk-button-link" href="<?php echo JRoute::_('index.php?option=com_donorwiz&view=dashboard&layout=volunteering_opportunities'); ?>">
					<i class="uk-icon-remove uk-icon-small"></i>
					<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_RESET');?>
				</a>
		<?php endif;?>
		
		<select class="uk-form-small uk-hidden" onchange="if (this.value) window.location.href=this.value">

			<option value="<?php echo $donorwizUrl -> getCurrentUrlWithNewParams( array ( 'created_by' => '' ) ); ?>" ><?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_SORT_BY_DATE');?></option>
			<option value="<?php echo $donorwizUrl -> getCurrentUrlWithNewParams( array ( 'created_by' => '' ) ); ?>" ><?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_SORT_BY_EVENT');?></option>
		
		</select>	
		
		<a href="#" class="uk-button uk-button-mini uk-button-primary filters-toggle <?php if( $resetlink == true ) echo 'uk-hidden';?>" onclick="jQuery('.filters-toggle').toggleClass('uk-hidden');" data-uk-toggle="{target:'#filters-toggle', animation:'uk-animation-slide-top, uk-animation-slide-bottom'}">
			<i class="uk-icon-angle-down uk-icon-large uk-margin-small-right"></i>
			<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_MORE');?>
		</a>
		
		<a href="#" class="uk-button uk-button-mini uk-button-primary filters-toggle <?php if( $resetlink == false ) echo 'uk-hidden';?>" onclick="jQuery('.filters-toggle').toggleClass('uk-hidden');" data-uk-toggle="{target:'#filters-toggle', animation:'uk-animation-slide-top, uk-animation-slide-bottom'}">
			<i class="uk-icon-angle-up uk-icon-large uk-margin-small-right"></i>
			<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_LESS');?>
		</a>
	
	</div>
	


	<div id="filters-toggle" class="uk-form uk-animation-slide-top<?php if( $resetlink == false ) echo ' uk-hidden';?>">
	
			<div class="uk-grid uk-grid-small uk-margin-small-top">
				
				<div class="uk-width-medium-1-2">
					
						
						<?php if(!$dashboard):?>
						
						<select class="uk-form-large uk-width-1-1" onchange="if (this.value) window.location.href=this.value" <?php if ( !count( $beneficiaries ) ) echo 'disabled="true"'; ?> >

							<option value="<?php echo $donorwizUrl -> getCurrentUrlWithNewParams( array ( 'created_by' => '' ) ) ;?>" ><?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_ORGANIZATION');?></option>
							
							<?php if ( count( $beneficiaries ) ) : ?>
								
								<?php foreach ( $beneficiaries as $key => $value) : ?>

									<option <?php if( $jinput->get('created_by', '', 'string') != $value['user_id'] ) { echo "value='".$donorwizUrl -> getCurrentUrlWithNewParams( array ( 'created_by' => $value['user_id'] ) )."' ";}  ?> <?php if( $jinput->get('created_by', '', 'string') == $value['user_id'] ) echo 'selected="selected"'?> ><?php echo $value['name'];?></option>

								<?php endforeach;?>
							
							<?php endif; ?>
						
						</select>
						
						<?php endif;?>
					
	
				</div>
				
				<div class="uk-width-medium-1-2">
					
						<select class="uk-form-large uk-width-1-1" onchange="if (this.value) window.location.href=this.value">
						
							<option value="<?php echo $donorwizUrl -> getCurrentUrlWithNewParams( array ( 'causearea' => '' ) ); ?>" ><?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITY_CAUSE_AREA');?></option>
							
							<?php if ( $causeareas && count( $causeareas ) > 0 ) : ?>
								
								<?php foreach ($causeareas as $key => $causearea) :  ?>

									<option 
									<?php if( $jinput->get('causearea', '', 'string') != $causearea) { echo "value='".$donorwizUrl -> getCurrentUrlWithNewParams( array( 'causearea' => $causearea ) )."' "; } ?> 
									<?php if( $jinput->get('causearea', '', 'string') == $causearea ) echo 'selected="selected"'?> >
										<?php echo JText::_($causearea);?>
									</option>
									
								<?php endforeach;?>
								
							<?php endif; ?>
						
						</select>
			
				</div>
			</div>		
		
		<?php if(!$dashboard):?>
			
			<form class="uk-form" method="get" action="<?php echo JURI::current();?>">
			
				<div class="uk-grid uk-grid-small uk-margin-small-top">
				
					<div class="uk-width-medium-1-2">

						<?php JFormHelper::addFieldPath( JPATH_SITE . '/components/com_donorwiz/models/fields/addressautocomplete'); ?>
						<?php $addressautocomplete = JFormHelper::loadFieldType('addressautocomplete', false);?>
						<?php echo $addressautocomplete ->getInput();?>
					
					</div>

					<div class="uk-width-medium-1-2">
						<button type="submit" class="uk-button uk-button-primary uk-button-large uk-width-1-1"><?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITIES_FILTERS_NEARBY');?></button>
					</div>
				</div>
			</form>
			
		<?php endif; ?>
	</div>
	

	<div class="uk-grid uk-grid-small uk-margin-small-top">
			
		<div class="uk-width-medium-1-2">
		
			<a class="uk-button uk-button-large uk-width-1-1 truncate<?php if( $jinput->get('category', '', 'string') == 'local') {echo 'uk-active uk-button-success';} ?>" href="<?php echo $donorwizUrl -> getCurrentUrlWithNewParams( array ( 'category' => 'local' ) ); ?>" data-uk-tooltip="{pos:'bottom'}" title="<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITY_LOCAL_TOOLTIP');?>">
				<i class="uk-icon-map-marker uk-icon-small"></i>
				<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITY_LOCAL');?>
			</a>
			
		</div>
			
		<div class="uk-width-medium-1-2">
			
			<a class="uk-button uk-button-large uk-width-1-1 truncate<?php if( $jinput->get('category', '', 'string') == 'virtual') {echo 'uk-active uk-button-success';} ?>" href="<?php echo $donorwizUrl -> getCurrentUrlWithNewParams( array ( 'category' => 'virtual' ) ); ?>" data-uk-tooltip="{pos:'bottom'}" title="<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITY_VIRTUAL_TOOLTIP');?>">
				<i class="uk-icon-laptop uk-icon-small"></i>
				<?php echo JText::_('COM_DW_OPPORTUNITIES_OPPORTUNITY_VIRTUAL');?>
			</a>
		
		</div>	
		
	</div>

</div>
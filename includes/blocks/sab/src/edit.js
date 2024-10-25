import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, ToggleControl } from '@wordpress/components';
import './editor.scss';
import Block from './block';
import metadata from './block.json';

export default function Edit( { attributes, setAttributes, clientId } ) {
	const blockProps = useBlockProps();

	setAttributes({
		blockId: clientId,
		blockVersion: metadata.version,
	});

	return (
		<>
			<Block
				blockProps={ blockProps }
				attributes={ attributes }
				setAttributes={setAttributes}
				isEditor={true}
			/>
			<InspectorControls>
				<PanelBody
					title={__('API Data Settings', 'Sab')}
				>
					<PanelRow>
						<ToggleControl
							checked={ attributes.showIdColumn }
							label={ __('Show ID Column', 'Sab') }
							onChange={ (value) => setAttributes({ showIdColumn: value }) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							checked={ attributes.showFirstNameColumn }
							label={ __('Show FirstName Column', 'Sab') }
							onChange={ (value) => setAttributes({ showFirstNameColumn: value }) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							checked={ attributes.showLastNameColumn }
							label={ __('Show Last Name Column', 'Sab') }
							onChange={ (value) => setAttributes({ showLastNameColumn: value }) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							checked={ attributes.showEmailColumn }
							label={ __('Show Email Column', 'Sab') }
							onChange={ (value) => setAttributes({ showEmailColumn: value }) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							checked={ attributes.showDateColumn }
							label={ __('Show Date Column', 'Sab') }
							onChange={ (value) => setAttributes({ showDateColumn: value }) }
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
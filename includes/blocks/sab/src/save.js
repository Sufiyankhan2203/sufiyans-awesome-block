import { useBlockProps } from '@wordpress/block-editor';
import Block from './block';

export default function save({ attributes }) {
    const blockProps = useBlockProps.save({
        id: attributes.blockId,
    });

    return <Block blockProps={ blockProps } attributes={ attributes } />;
}
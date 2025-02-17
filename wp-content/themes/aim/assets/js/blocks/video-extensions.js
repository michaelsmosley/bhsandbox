const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls, MediaUpload } = wp.blockEditor;
const { PanelBody, Button } = wp.components;

// Add custom controls to video block
const withCustomVideoControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        if (props.name !== 'core/video') {
            return <BlockEdit {...props} />;
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody title="Custom Video Settings">
                        <MediaUpload
                            onSelect={(media) => {
                                props.setAttributes({
                                    customPoster: media
                                });
                            }}
                            type="image"
                            render={({ open }) => (
                                <Button onClick={open}>
                                    Choose Custom Poster
                                </Button>
                            )}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'withCustomVideoControls');

addFilter(
    'editor.BlockEdit',
    'aim/custom-video-controls',
    withCustomVideoControls
);

wp.domReady(() => {
    wp.blocks.unregisterBlockType('core/video');
}); 
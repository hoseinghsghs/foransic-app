$(document).ready(function () {
    // file manager

    window.generateFileManagerFeature = function (element, options = {}) {
        if (typeof finalFileManagerOptions == "undefined") return false;

        const mOptions = getDataOptionPlugin(element, options);
        element.on("click", function () {
            openFileManager(mOptions);
        });

        element.on("closeFileManager", function () {
            if (mOptions["preview"]) window[mOptions.onCloseCallback](mOptions);
        });
    };
    let urlpostimg = window.location.origin + "/postimg";
    window.fileMangerOptions = {
        multiple: false,
        dataMutipleMaxItem: 0,
        groupType: "all",
        target: null,
        dialogReload: true,
        // url: "https://api.rapidcode.ir/rest/index.php/products",
        url: urlpostimg,
        iconFileUrl: "static/images/file.png",
        preview: false,
        previewSelector: "#preview-thumbnails",
        onCloseCallback: null,
    };

    // end file manager

    // functions

    window.getElementByNthChild = function (
        parentSelector,
        childSelector,
        index
    ) {
        return $(parentSelector).find(childSelector).eq(index);
    };

    window.getDataOptionPlugin = function (element, options) {
        const dataOptions = element.attr("data-options")
            ? JSON.parse(element.attr("data-options"))
            : {};
        const mOptions = Object.assign({}, options);

        for (const key of Object.keys(dataOptions)) {
            const currentElement = dataOptions[key];
            mOptions[key] = currentElement;
        }

        return mOptions;
    };

    window.generateFeatureTinyMce = function (options) {
        if (typeof tinymce == "undefined") return false;

        const element = $(options["selector"]);
        const mOptions = getDataOptionPlugin(element, options);
        const res = tinymce.init(mOptions);
        return res;
    };

    window.setupTinyMce = function (editor) {
        // custom footer button
        editor.on("init", tinyMceEditLink);

        // callback for getting html and raw content tinymce
        editor.on("init", getContentTinyMce);
        editor.on("keyup", getContentTinyMce);

        // add toolbar button and dialog
        addCustomToolbarsTinyMce(editor);
    };

    window.getContentTinyMce = function (e) {
        const editor = this;
        const thisElement = $("#" + editor.id);
        let rawContent = editor.getContent({ format: "text" });
        rawContent = rawContent
            .replace("\n", "")
            .replace(/\s{2,}/gi, " ")
            .replace(/\t{2,}/gi, " ");
        const htmlContent = editor.getContent();

        const rawContentField = $("#" + editor.id + "_raw");
        const htmlContentField = $("#" + editor.id + "_html");

        if (rawContentField.length) rawContentField.val(rawContent);
        if (htmlContentField.length) htmlContentField.val(htmlContent);

        thisElement.val(htmlContent);
    };

    window.generateDimensionImageTinyMce = function (inputTarget) {
        const target = $(inputTarget);

        target.on("textInput", function (e) {
            const thisElement = $(this);
            const image = new Image();
            image.src = thisElement.val();
            $(image).on("load", function (e) {
                const [width, height] = [image.width, image.height];
                getElementByNthChildTinyMce(3).val(width);
                getElementByNthChildTinyMce(4).val(height);
            });
        });

        target.on("importFileURL", function () {
            $(this).trigger("textInput");
        });
    };

    window.getSelectionVideoObjectTinyMce = function (
        editor,
        selector = '[data-mce-object="video"]'
    ) {
        const domSelected = $(editor.selection.getNode());
        const foundedDOM = domSelected.find(selector).last();
        return foundedDOM;
    };

    window.getElementByNthChildTinyMce = function (number) {
        const [parent, child, index] = [
            ".tox-dialog__body",
            "input",
            number - 1,
        ];
        return getElementByNthChild(parent, child, index);
    };

    window.addCustomMediaBtnTinyMce = function (
        editor,
        title,
        parent,
        elementStrTemplate,
        callback = null
    ) {
        const element = $(elementStrTemplate);
        const attrOptions = element.attr("data-options");
        const options = attrOptions ? JSON.parse(attrOptions) : {};
        const inputTarget = options.target;
        if (editor.title == title) {
            $(parent).append(element);
            generateFileManagerFeature(element, fileMangerOptions);
            if (callback) {
                window[callback](inputTarget);
            }

            return true;
        }

        return false;
    };

    window.tinyMceEditLink = function (e) {
        const editor = e.target;
        editor.windowManager.oldOpen = editor.windowManager.open;
        editor.windowManager.open = function (windowMNG, r) {
            var modal = this.oldOpen.apply(this, [windowMNG, r]);

            const mediaPopUpIntreact = {
                target: null,
                importBtn: null,
            };

            // insert image
            mediaPopUpIntreact["target"] = getElementByNthChildTinyMce(1);
            mediaPopUpIntreact[
                "importBtn"
            ] = `<input type="button" id="image_import_image_tinymce" class="openTheFileManager tox-button" value="افزودن تصویر" data-options='{ "multiple":false, "groupType":"image", "target": "#${mediaPopUpIntreact[
                "target"
            ].attr("id")}" }'>`;
            addCustomMediaBtnTinyMce(
                windowMNG,
                "Insert/Edit Image",
                ".tox-dialog__footer-end",
                mediaPopUpIntreact["importBtn"],
                "generateDimensionImageTinyMce"
            );

            // insert video
            // video
            mediaPopUpIntreact["target"] = getElementByNthChildTinyMce(2);
            mediaPopUpIntreact[
                "importBtn"
            ] = `<input type="button" id="image_import_video_poster_tinymce" class="openTheFileManager tox-button" value="افزودن پوستر تصویر" data-options='{ "multiple":false, "groupType":"image", "target": "#${mediaPopUpIntreact[
                "target"
            ].attr("id")}" }'>`;
            addCustomMediaBtnTinyMce(
                windowMNG,
                "Insert/Edit Video",
                ".tox-dialog__footer-end",
                mediaPopUpIntreact["importBtn"]
            );
            // video poster
            mediaPopUpIntreact["target"] = getElementByNthChildTinyMce(1);
            mediaPopUpIntreact[
                "importBtn"
            ] = `<input type="button" id="image_import_video_tinymce" class="openTheFileManager tox-button" value="افزودن ویدیو" data-options='{ "multiple":false, "groupType":"video", "target": "#${mediaPopUpIntreact[
                "target"
            ].attr("id")}" }'>`;
            addCustomMediaBtnTinyMce(
                windowMNG,
                "Insert/Edit Video",
                ".tox-dialog__footer-end",
                mediaPopUpIntreact["importBtn"]
            );

            return modal;
        };
    };

    window.addCustomToolbarsTinyMce = function (editor) {
        // video
        editor.ui.registry.addToggleButton("csVideo", {
            icon: "embed",
            tooltip: "Insert Video",
            onAction: function (e) {
                const res = editor.windowManager.open({
                    title: "Insert/Edit Video",
                    body: {
                        type: "panel",
                        items: [
                            {
                                type: "input",
                                name: "source",
                                label: "Source (URL)",
                            },
                            {
                                type: "selectbox",
                                name: "preload",
                                label: "Preload",
                                items: [
                                    {
                                        value: "auto",
                                        text: "Auto",
                                    },
                                    {
                                        value: "metadata",
                                        text: "Meta Data",
                                    },
                                    {
                                        value: "none",
                                        text: "None",
                                    },
                                ],
                            },
                            {
                                type: "input",
                                name: "poster",
                                label: "Poster (URL)",
                            },
                            {
                                type: "sizeinput",
                                name: "dimension",
                            },
                        ],
                    },
                    buttons: [
                        {
                            type: "cancel",
                            name: "closeButton",
                            text: "Cancel",
                        },
                        {
                            type: "submit",
                            name: "submitButton",
                            text: "Save",
                            primary: true,
                        },
                    ],
                    initialData: {
                        dimension: {
                            width: "300",
                            height: "150",
                        },
                    },
                    onSubmit: (api) => {
                        const data = api.getData();
                        const autoload = data.preload;
                        const poster =
                            data.poster != "" ? `poster="${data.poster}"` : "";
                        const source = data.source.trim();

                        const dimension = data.dimension;
                        const width = dimension.width ? dimension.width : "300";
                        const height = dimension.height
                            ? dimension.height
                            : "150";

                        const templateHtml = `<video class="video tinymce video-rapidcode" width="${width}" controls height="${height}" src="${source}" preload="${autoload}" ${poster}></video>`;

                        if (source) {
                            const currentSelection =
                                editor.currentSelectionOnAction;
                            if (
                                currentSelection &&
                                editor.currentSelectionOnAction.length
                            ) {
                                currentSelection.remove();
                            }
                            tinymce.activeEditor.execCommand(
                                "mceInsertContent",
                                false,
                                templateHtml
                            );
                            api.close();
                        } else {
                            const options = sweetAlertOptions.info;
                            options.title = "Require Field";
                            options.text = "Source not completed !";
                            Swal.fire(options);
                        }
                    },
                });
                const currentSelectionOnAction =
                    getSelectionVideoObjectTinyMce(editor);
                editor.currentSelectionOnAction = currentSelectionOnAction;
                if (currentSelectionOnAction.length) {
                    const prefix = "data-mce-p-";
                    // force to use poster
                    let poster = currentSelectionOnAction.attr(
                        prefix + "poster"
                    );
                    poster = poster ? poster : "";
                    res.setData({
                        source: currentSelectionOnAction.attr(prefix + "src"),
                        preload: currentSelectionOnAction.attr(
                            prefix + "preload"
                        ),
                        poster: poster,
                        dimension: {
                            width: currentSelectionOnAction.attr("width"),
                            height: currentSelectionOnAction.attr("height"),
                        },
                    });
                }
            },
            onSetup: function (buttonApi) {
                const checkBtnActive = function (e) {
                    const foundedDOM = getSelectionVideoObjectTinyMce(editor);
                    if (foundedDOM.length) {
                        buttonApi.setActive(true);
                    } else {
                        buttonApi.setActive(false);
                    }
                };
                editor.on("NodeChange", checkBtnActive);
            },
        });

        // align
        editor.ui.registry.addGroupToolbarButton("alignGroup", {
            icon: "align-justify",
            tooltip: "Alignment",
            items: "alignleft aligncenter alignright alignjustify",
        });

        // featured Format
        editor.ui.registry.addGroupToolbarButton("featuredFormat", {
            icon: "color-picker",
            tooltip: "Format Style",
            items: "bold italic forecolor backcolor emoticons",
        });
    };

    // options
    window.tinymceOptions = {
        language: "fa_IR",
        content_style: "", // if need to style
        selector: "",
        placeholder: "",
        force_p_newlines: false,
        force_br_newlines: true,
        convert_newlines_to_brs: false,
        remove_linebreaks: true,
        setup: function () {}, // callback whene tinymce set up
        height: 500,
        plugins: [
            // list of plugins to use
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table directionality emoticons template paste",
        ],
        toolbar_mode: "floating", // toolbar mode
        toolbar:
            /* toolbar order display */ "insertfile undo redo | styleselect | image csVideo | alignGroup | featuredFormat | link | bullist numlist | outdent indent | print preview fullpage",
        style_formats: [
            /* style order display */ { title: "Head 1", block: "h1" },
            { title: "Head 2", block: "h2" },
            { title: "Head 3", block: "h3" },
            { title: "Head 4", block: "h4" },
            { title: "Head 5", block: "h5" },
            { title: "Head 6", block: "h6" },
            { title: "Bold text", inline: "b" },
            { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
            { title: "Example 1", inline: "span", classes: "example1" },
        ],
    };

    // tinymce init
    const textEditorsSelector = ".editor";
    const editorWYS = $(textEditorsSelector);
    if (editorWYS.length) {
        const myTinyMce = tinymceOptions;
        Array.from(editorWYS).forEach(function (textEditor, index) {
            myTinyMce["selector"] = textEditorsSelector + ":eq(" + index + ")";
            myTinyMce["placeholder"] = $(textEditor).attr("placeholder");
            myTinyMce["setup"] = setupTinyMce;
            generateFeatureTinyMce(myTinyMce);
        });
    }
});

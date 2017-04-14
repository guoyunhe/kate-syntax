<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE language SYSTEM "language.dtd"
[
<?php require('html-entities.php') ?>
]>
<!--

Pug, known as Jade before, is a HTML template engine.

https://pugjs.org/

Changelog

Version 1 - Guo Yunhe guoyunhebrave@gmail.com - 2017-04-14
- Basic Pug/Jade syntax support
- Do NOT support multi-line comment or text block

-->
<language name="Pug" version="1" kateversion="5.0" section="Markup"
          extensions="*.pug;*.jade" mimetype="text/plain" priority="10"
          author="Guo Yunhe (guoyunhebrave@gmail.com)" license="LGPL">
<highlighting>
<contexts>
    <context name="Start" attribute="Normal Text" lineEndContext="#stay">
        <Detect2Chars attribute="Comment" context="Comment" char="/" char1="/" />
        <DetectIdentifier attribute="Normal Text"  context="Element" firstNonSpace="true" lookAhead="true" />
        <DetectChar attribute="Normal Text" context="Element" char="#" firstNonSpace="true" lookAhead="true" />
        <DetectChar attribute="Normal Text" context="Element" char="." firstNonSpace="true" lookAhead="true" />
        <DetectChar attribute="Normal Text" context="JavaScript" char="-" firstNonSpace="true" />
        <DetectChar attribute="Normal Text" context="#stay" char="|" firstNonSpace="true" />
    </context>

    <context name="FindEntityRefs" attribute="Normal Text" lineEndContext="#stay">
        <RegExpr attribute="EntityRef" context="#stay" String="&entity;" />
        <AnyChar attribute="Error" context="#stay" String="&amp;&lt;" />
    </context>

    <context name="Element" attribute="Normal Text" lineEndContext="#pop">
        <DetectChar attribute="Normal Text" context="Text" char=" " />
        <RegExpr attribute="Element" context="#stay" String="&name;" />
        <RegExpr attribute="ID" context="#stay" String="#&name;" />
        <RegExpr attribute="Class" context="#stay" String="\.&name;" />
        <DetectChar attribute="Normal Text" context="Attributes" char="(" />
        <StringDetect attribute="Normal Text" context="AttributeObject" String="&amp;attributes(" />
    </context>

    <context name="Attributes" attribute="Normal Text" lineEndContext="#stay">
        <RegExpr attribute="Attribute" context="Attribute" String="&name;" />
        <RegExpr attribute="Attribute" context="Attribute" String="\(&name;\)" />
        <DetectChar attribute="Normal Text" context="#pop" char=")" />
    </context>

    <context name="AttributeObject" attribute="Normal Text" lineEndContext="#stay">
        <DetectChar attribute="Normal Text" context="#pop" char=")" />
        <IncludeRules context="Normal##JavaScript" includeAttrib="true"/>
    </context>

    <context name="Attribute" attribute="Attribute" lineEndContext="#pop">
        <DetectChar attribute="Normal Text" context="#pop" char="," />
        <DetectChar attribute="Normal Text" context="#pop#pop" char=")" />
        <DetectChar attribute="Attribute" context="Value" char="=" />
    </context>

    <context name="Value" attribute="Normal Text" lineEndContext="#pop">
        <DetectChar attribute="Normal Text" context="#pop#pop" char="," />
        <DetectChar attribute="Normal Text" context="#pop#pop#pop" char=")" />
        <IncludeRules context="Normal##JavaScript" includeAttrib="true"/>
    </context>

    <context name="Text" attribute="Normal Text" lineEndContext="#pop">
        <DetectSpaces />
    </context>

    <context name="JavaScript" attribute="Normal Text" lineEndContext="#pop">
        <IncludeRules context="Normal##JavaScript" includeAttrib="true"/>
    </context>

    <context name="Comment" attribute="Comment" lineEndContext="#pop">
        <IncludeRules context="##Alerts" />
    </context>
</contexts>
<itemDatas>
    <itemData name="Normal Text" defStyleNum="dsNormal" />
    <itemData name="Comment" defStyleNum="dsComment" />
    <itemData name="CDATA" defStyleNum="dsBaseN" bold="1" spellChecking="false" />
    <itemData name="Processing Instruction" defStyleNum="dsKeyword" spellChecking="false" />
    <itemData name="Doctype" defStyleNum="dsDataType" bold="1" spellChecking="false" />

    <itemData name="Element" defStyleNum="dsKeyword" spellChecking="false" />
    <itemData name="ID" defStyleNum="dsPreprocessor" spellChecking="false" />
    <itemData name="Class" defStyleNum="dsFunction" spellChecking="false" />
    <itemData name="Attribute" defStyleNum="dsAttribute" spellChecking="false" />
    <itemData name="Value" defStyleNum="dsString" spellChecking="false" />

    <itemData name="EntityRef" defStyleNum="dsDecVal" spellChecking="false" />
    <itemData name="PEntityRef" defStyleNum="dsDecVal" spellChecking="false" />

    <itemData name="Error" defStyleNum="dsError" spellChecking="false" />
</itemDatas>
</highlighting>
<general>
    <keywords casesensitive="1" weakDeliminator="-"/>
    <comments>
        <comment name="singleLine" start="//-" />
        <comment name="singleLine" start="//" />
    </comments>
    <indentation mode="python" />
    <folding indentationsensitive="1" />
    <emptyLines>
        <emptyLine regexpr="(?:\s+|\s*#.*)"/>
    </emptyLines>
</general>
</language>

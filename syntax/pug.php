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
<list name="controlflow">
    <item> case </item>
    <item> when </item>
    <item> default </item>
    <item> if </item>
    <item> unless </item>
    <item> else if </item>
    <item> else </item>
    <item> each </item>
    <item> while </item>
</list>
<contexts>
    <context name="Start" attribute="Normal Text" lineEndContext="#stay">
        <Detect2Chars attribute="Comment" context="Comment" char="/" char1="/" />
        <StringDetect attribute="Doctype" context="#stay" String="doctype" insensitive="true" />
        <keyword attribute="ControlFlow" context="JavaScript" String="controlflow" firstNonSpace="true" />
        <DetectIdentifier attribute="Normal Text"  context="Element" firstNonSpace="true" lookAhead="true" />
        <DetectChar attribute="Normal Text" context="Element" char="#" firstNonSpace="true" lookAhead="true" />
        <DetectChar attribute="Normal Text" context="Element" char="." firstNonSpace="true" lookAhead="true" />
        <DetectChar attribute="Normal Text" context="JavaScript" char="-" firstNonSpace="true" />
        <DetectChar attribute="Normal Text" context="#stay" char="|" firstNonSpace="true" />
    </context>

    <context name="FindInterpolation" attribute="Normal Text" lineEndContext="#stay">
        <Detect2Chars attribute="Interpolation" context="JavaScript" char="#" char1="{" />
        <DetectChar attribute="Interpolation" context="#stay" char="}" />
    </context>

    <context name="FindEntities" attribute="Normal Text" lineEndContext="#stay">
        <RegExpr attribute="Entity" context="#stay" String="&entity;" />
        <AnyChar attribute="Error" context="#stay" String="&amp;&lt;" />
    </context>

    <context name="Element" attribute="Normal Text" lineEndContext="#pop">
        <RegExpr attribute="Element" context="#stay" String="&name;" />
        <RegExpr attribute="ID" context="#stay" String="#&name;" />
        <RegExpr attribute="Class" context="#stay" String="\.&name;" />
        <DetectChar attribute="Normal Text" context="Attributes" char="(" />
        <StringDetect attribute="Normal Text" context="AttributeObject" String="&amp;attributes(" />
        <RegExpr attribute="Normal Text" context="Element" String=":\s+" />
        <RegExpr attribute="Normal Text" context="JavaScript" String="=\s+" />
        <DetectChar attribute="Normal Text" context="Text" char=" " />
    </context>

    <context name="Attributes" attribute="Normal Text" lineEndContext="#stay">
        <RegExpr attribute="Attribute" context="Attribute" String="(&name;|\(&name;\))" />
        <DetectChar attribute="Normal Text" context="#pop" char=")" />
    </context>

    <context name="AttributeObject" attribute="Normal Text" lineEndContext="#stay">
        <DetectChar attribute="Normal Text" context="#pop" char=")" />
        <IncludeRules context="Normal##JavaScript" includeAttrib="true"/>
    </context>

    <context name="Attribute" attribute="Attribute" lineEndContext="#pop">
        <AnyChar attribute="Normal Text" context="#pop" String=",)" lookAhead="true" />
        <RegExpr attribute="Attribute" context="#pop" String="\s+(&name;|\(&name;\))(=|\s|\))" lookAhead="true" />
        <DetectChar attribute="Attribute" context="Value" char="=" />
    </context>

    <context name="Value" attribute="Normal Text" lineEndContext="#pop">
        <AnyChar attribute="Normal Text" context="#pop" String=",)" lookAhead="true" />
        <RegExpr attribute="Attribute" context="#pop" String="\s+(&name;|\(&name;\))(=|\s|\))" lookAhead="true" />
        <IncludeRules context="Normal##JavaScript" includeAttrib="true"/>
    </context>

    <context name="Text" attribute="Normal Text" lineEndContext="#pop">
        <DetectSpaces />
        <IncludeRules context="FindEntities" includeAttrib="true"/>
        <IncludeRules context="FindInterpolation" includeAttrib="true"/>
    </context>

    <context name="JavaScript" attribute="Normal Text" lineEndContext="#pop">
        <IncludeRules context="Normal##JavaScript" includeAttrib="true"/>
        <AnyChar attribute="Normal Text" context="#pop" String=",)}:" lookAhead="true" />
    </context>

    <context name="Comment" attribute="Comment" lineEndContext="#pop">
        <IncludeRules context="##Alerts" />
    </context>
</contexts>
<itemDatas>
    <?php require('javascript-styles.php') ?>
    <itemData name="CDATA" defStyleNum="dsBaseN" bold="1" spellChecking="false" />
    <itemData name="Processing Instruction" defStyleNum="dsKeyword" spellChecking="false" />
    <itemData name="Doctype" defStyleNum="dsDataType" bold="1" spellChecking="false" />

    <itemData name="Element" defStyleNum="dsKeyword" spellChecking="false" />
    <itemData name="ID" defStyleNum="dsPreprocessor" spellChecking="false" />
    <itemData name="Class" defStyleNum="dsFunction" spellChecking="false" />
    <itemData name="Attribute" defStyleNum="dsAttribute" spellChecking="false" />
    <itemData name="Entity" defStyleNum="dsDecVal" spellChecking="false" />
    <itemData name="Interpolation" defStyleNum="dsPreprocessor" spellChecking="false" />
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

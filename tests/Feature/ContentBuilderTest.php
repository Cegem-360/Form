<?php

declare(strict_types=1);
/*
use App\Helper\ContentBuilder;

it('builds content to home hero title', function () {
    $result = ContentBuilder::buildContent(53, ['companyName' => 'TestCompany']);
    expect($result)->toBe('Címsorhoz tartalom TestCompany maximum 50 karakter hosszúságban.');
});

it('builds content to home hero description', function () {
    $result = ContentBuilder::buildContentToHomeHeroDesciption('Short description');
    expect($result)->toBe('A címsorhoz a következő tartalom tartozik: Short description');
});

it('builds content with id 53', function () {
    $data = ['companyName' => 'TestCompany'];
    $result = ContentBuilder::buildContent(53, $data);
    expect($result)->toBe('Címsorhoz tartalom TestCompanymaximum 50 karakter hosszúságban.');
});

it('builds content with id 58', function () {
    $result = ContentBuilder::buildContent(58, []);
    expect($result)->toBe('A címsorhoz a következő tartalom tartozik: ');
});

it('builds content with default id', function () {
    $result = ContentBuilder::buildContent(99, []);
    expect($result)->toBe('');
});

it('gets content', function () {
    $contentBuilder = new ContentBuilder('Initial content');
    expect($contentBuilder->getContent())->toBe('Initial content');
});

it('sets content', function () {
    $contentBuilder = new ContentBuilder('Initial content');
    $contentBuilder->setContent('Updated content');
    expect($contentBuilder->getContent())->toBe('Updated content');
});

it('builds content with empty company name', function () {
    $result = ContentBuilder::buildContentToHomeHeroTitle('');
    expect($result)->toBe('Címsorhoz tartalom maximum 50 karakter hosszúságban.');
});

it('builds content with empty description', function () {
    $result = ContentBuilder::buildContentToHomeHeroDesciption('');
    expect($result)->toBe('A címsorhoz a következő tartalom tartozik: ');
});

it('handles missing company name in data array', function () {
    $data = [];
    $result = ContentBuilder::buildContent(53, $data);
    expect($result)->toBe('Címsorhoz tartalom maximum 50 karakter hosszúságban.');
}); */

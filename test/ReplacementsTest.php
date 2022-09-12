<?php

declare(strict_types=1);

namespace LaminasTest\DependencyPlugin;

use Laminas\DependencyPlugin\Replacements;
use PHPUnit\Framework\TestCase;

final class ReplacementsTest extends TestCase
{
    private Replacements $replacements;

    protected function setUp(): void
    {
        parent::setUp();
        $this->replacements = new Replacements();
    }

    /**
     * @dataProvider ignoredZendPackages
     * @dataProvider ignoredZFCampusPackages
     * @dataProvider zendToLaminasPackageNames
     */
    public function testWillReplacePackageNames(string $packageName, string $expectedPackageName): void
    {
        $transformedPackageName = $this->replacements->transformPackageName($packageName);
        $this->assertEquals($expectedPackageName, $transformedPackageName);
    }

    /**
     * @psalm-return iterable<array-key, array{0: string, 1: string}>
     */
    public function zendToLaminasPackageNames(): iterable
    {
        yield 'zendframework/zenddiagnostics' => ['zendframework/zenddiagnostics', 'laminas/laminas-diagnostics'];
        yield 'zendframework/zendoauth' => ['zendframework/zendoauth', 'laminas/laminas-oauth'];
        yield 'zendframework/zendservice-recaptcha' => [
            'zendframework/zendservice-recaptcha',
            'laminas/laminas-recaptcha',
        ];
        yield 'zendframework/zendservice-twitter' => ['zendframework/zendservice-twitter', 'laminas/laminas-twitter'];
        yield 'zendframework/zendxml' => ['zendframework/zendxml', 'laminas/laminas-xml'];
        yield 'zendframework/zend-expressive' => ['zendframework/zend-expressive', 'mezzio/mezzio'];
        yield 'zendframework/zend-problem-details' => [
            'zendframework/zend-problem-details',
            'mezzio/mezzio-problem-details',
        ];
        yield 'zfcampus/zf-apigility' => ['zfcampus/zf-apigility', 'laminas-api-tools/api-tools'];
        yield 'zfcampus/zf-composer-autoloading' => [
            'zfcampus/zf-composer-autoloading',
            'laminas/laminas-composer-autoloading',
        ];
        yield 'zfcampus/zf-development-mode' => ['zfcampus/zf-development-mode', 'laminas/laminas-development-mode'];

        yield 'zendframework/zend-expressive-zend regex' => [
            'zendframework/zend-expressive-zendviewrenderer',
            'mezzio/mezzio-laminasviewrenderer',
        ];

        yield 'zendframework/zend-expressive-zend* regex' => [
            'zendframework/zend-expressive-zendviewrenderer',
            'mezzio/mezzio-laminasviewrenderer',
        ];

        yield 'zendframework/zend-expressive-* regex' => [
            'zendframework/zend-expressive-router',
            'mezzio/mezzio-router',
        ];

        yield 'zfcampus/zf-apigility-* regex' => [
            'zfcampus/zf-apigility-doctrine',
            'laminas-api-tools/api-tools-doctrine',
        ];

        yield 'zfcampus/zf-* regex' => ['zfcampus/zf-rest', 'laminas-api-tools/api-tools-rest'];

        yield 'zendframework/zend-* regex' => ['zendframework/zend-config', 'laminas/laminas-config'];
    }

    /**
     * @psalm-return iterable<array-key, array{0: string, 1: string}>
     */
    public function ignoredZendPackages(): iterable
    {
        yield 'ignored zend-debug' => ['zendframework/zend-debug', 'zendframework/zend-debug'];
        yield 'ignored zend-version' => ['zendframework/zend-version', 'zendframework/zend-version'];
        yield 'ignored zendservice-apple-apns' => [
            'zendframework/zendservice-apple-apns',
            'zendframework/zendservice-apple-apns',
        ];
        yield 'ignored zendservice-google-gcm' => [
            'zendframework/zendservice-google-gcm',
            'zendframework/zendservice-google-gcm',
        ];
    }

    /**
     * @psalm-return iterable<array-key, array{0: string, 1: string}>
     */
    public function ignoredZFCampusPackages(): iterable
    {
        yield 'ignored zf-apigility-example' => ['zfcampus/zf-apigility-example', 'zfcampus/zf-apigility-example'];
        yield 'ignored zf-angular' => ['zfcampus/zf-angular', 'zfcampus/zf-angular'];
        yield 'ignored zf-console' => ['zfcampus/zf-console', 'zfcampus/zf-console'];
        yield 'ignored zf-deploy' => ['zfcampus/zf-deploy', 'zfcampus/zf-deploy'];
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260426162141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX COUPONS_UNIQ_CODE ON coupons (code)');
        $this->addSql('CREATE UNIQUE INDEX TAX_RATES_UNIQ_COUNTRY_CODE ON tax_rates (country_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX COUPONS_UNIQ_CODE');
        $this->addSql('DROP INDEX TAX_RATES_UNIQ_COUNTRY_CODE');
    }
}
